<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'version_number',
        'changes_summary',
    ];

    public function document()
    {
        return $this->belongsTo(DocumentHeader::class, 'document_id');
    }
}
