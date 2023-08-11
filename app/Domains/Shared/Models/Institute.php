<?php

namespace App\Domains\Shared\Models;

use Database\Factories\InstituteFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'abbr',
        'color',
        'description',
        'general_url',
        'auth_url',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    public static function newFactory()
    {
        return InstituteFactory::new();
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Scopes
    |----------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    
    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
}
