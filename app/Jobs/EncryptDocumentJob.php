<?php

namespace App\Jobs;

use App\Models\DocumentBody;
use App\Models\DocumentHeader;
use App\Services\DocumentEncryptionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class EncryptDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $header;
    public $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DocumentHeader $header, DocumentBody $body)
    {
        $this->header = $header;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DocumentEncryptionService $encryptionService)
{
    
        // Encrypt the header and body separately
        $encryptedHeader = Crypt::encryptString(json_encode($this->header->toArray()));
        $encryptedBody = Crypt::encryptString($this->body->content);

        // Update the header and body with encrypted data
        $this->header->update([
            'encrypted_data' => $encryptedHeader,
        ]);

        $this->body->update([
            'encrypted_content' => $encryptedBody,
        ]);
    }
}

