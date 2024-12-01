<?php

namespace Database\Seeders;

use App\Models\DocumentHeader;
use App\Services\DocumentEncryptionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(DocumentEncryptionService $encryptionService)
    {
        $documents = [
            [
                'header' => 'General Document Header',
                'body' => 'General Document Body Content',
                'module' => 'General',
                'user_id' => 1,
            ],
            [
                'header' => 'Motors Document Header',
                'body' => 'Motors Document Body Content',
                'module' => 'Motors',
                'user_id' => 1,
            ],
            [
                'header' => 'Jobs Document Header',
                'body' => 'Jobs Document Body Content',
                'module' => 'Jobs',
                'user_id' => 2,
            ],
        ];

        foreach ($documents as $doc) {
            $encryptionKey = null;
            $encryptedHeader = $encryptionService->encrypt($doc['header'], $encryptionKey);
            $encryptedBody = $encryptionService->encrypt($doc['body'], $encryptionKey);
            $checksum = $encryptionService->calculateChecksum($doc['body']);

            $header = DocumentHeader::create([
                'user_id' => $doc['user_id'],
                'module' => $doc['module'],
                'version' => '1.0',
                'metadata' => json_encode(['tags' => ['sample', 'test']]),
                'encryption_key' => encrypt($encryptionKey),
            ]);

            $header->documentBodies()->create([
                'body' => $encryptedBody,
                'checksum' => $checksum,
            ]);
        }
    }
    }

