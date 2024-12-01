<?php

namespace App\Http\Controllers;

use App\Jobs\EncryptDocumentJob;
use App\Models\AuditLog;
use App\Models\DocumentHeader;
use App\Models\DocumentBody;
use App\Services\DocumentEncryptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class DocumentController extends Controller
{
    public function store(Request $request, DocumentEncryptionService $encryptionService)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'module' => 'required|string',
            'body' => 'required|string',
            'metadata' => 'nullable|json',
        ]);

        $encryptionKey = $encryptionService->generateKey();
        $encryptedBody = $encryptionService->encrypt($request->body, $encryptionKey);
        $checksum = $encryptionService->calculateChecksum($request->body);

        $header = DocumentHeader::create([
            'user_id' => $request->user_id,
            'module' => $request->module,
            'metadata' => $request->metadata,
            'encryption_key' => Crypt::encryptString($encryptionKey),
        ]);

       $body= DocumentBody::create([
            'document_header_id' => $header->id,
            'content' => $encryptedBody,
            'checksum' => $checksum,
        ]);
        EncryptDocumentJob::dispatch($header, $body);
        return response()->json(['message' => 'Document saved successfully.'], 201);
    }


    public function show($id, DocumentEncryptionService $encryptionService)
    { 
        $header = DocumentHeader::findOrFail($id);
        $body = DocumentBody::where('document_header_id', $id)->firstOrFail();

        $encryptionKey = Crypt::decryptString($header->encryption_key);
        $decryptedBody = $encryptionService->decrypt($body->content, $encryptionKey);

        if ($encryptionService->calculateChecksum($decryptedBody) !== $body->checksum) {
            return response()->json(['error' => 'Data integrity check failed.'], 400);
        }
        AuditLog::create([
            'user_id' => auth()->id(),
            'document_id' => $header->id,
            'action' => 'view',
            'timestamp' => now(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return response()->json([
            'header' => $header,
            'body' => $decryptedBody,
        ]);
    }
}
