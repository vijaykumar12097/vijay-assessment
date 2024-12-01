<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentBody extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_header_id',
        'content',
        'checksum',
    ];

    public function header()
    {
        return $this->belongsTo(DocumentHeader::class, 'document_header_id');
    }
}
