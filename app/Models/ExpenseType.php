<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExpenseType
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string $abbr
 * @property string|null $tagline
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\ExpenseTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ExpenseType extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'ulid',
        'name',
        'abbr',
        'tagline',
        'description',
    ];

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

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
}
