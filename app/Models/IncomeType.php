<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\IncomeType
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
 * @method static \Database\Factories\IncomeTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class IncomeType extends Model
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
