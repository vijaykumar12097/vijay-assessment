<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'enabled',
        'last_migrated_at',
    ];

    /**
     * Scope to get only enabled modules.
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    /**
     * Get the full name of the module's migration folder.
     */
    public function getMigrationPath()
    {
        return database_path("migrations/modules/{$this->name}");
    }
}
