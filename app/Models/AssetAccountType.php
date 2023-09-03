<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AssetAccountType
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string $abbr
 * @property string|null $tagline
 * @property string|null $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\AssetAccountTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AssetAccountType extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'name',
        'abbr',
        'tagline',
        'description',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }
}
