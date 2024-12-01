<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module',
        'version',
        'metadata',
        'encryption_key',
    ];

    public function body()
    {
        return $this->hasOne(DocumentBody::class, 'document_header_id');
    }

    public function versions()
    {
        return $this->hasMany(Version::class, 'document_id');
    }
}
