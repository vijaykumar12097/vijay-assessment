<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class DocumentEncryptionService
{
    public function generateKey()
    {
        return base64_encode(random_bytes(32)); // AES-256 key
    }

    public function encrypt($data, $key)
    {
        $key = base64_decode($key);
        return openssl_encrypt($data, 'aes-256-cbc', $key, 0, substr($key, 0, 16));
    }

    public function decrypt($encryptedData, $key)
    {
        $key = base64_decode($key);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, substr($key, 0, 16));
    }

    public function calculateChecksum($data)
    {
        return hash('sha256', $data);
    }
}
