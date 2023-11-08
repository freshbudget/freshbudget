<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Institute
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string $abbr
 * @property string|null $color
 * @property string|null $logo
 * @property string|null $description
 * @property string|null $general_url
 * @property string|null $auth_url
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Institute active()
 * @method static \Database\Factories\InstituteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Institute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereAuthUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereGeneralUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereUpdatedAt($value)
 * @property int|null $budget_id
 * @property int|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereUserId($value)
 * @property-read Budget|null $budget
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Institute budget($budget)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute global()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute inactive()
 * @mixin \Eloquent
 */
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
        'budget_id',
        'user_id',
    ];

    protected $casts = [
        'active' => 'boolean',
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
    | Scopes
    |----------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    public function scopeGlobal($query)
    {
        return $query->whereNull('budget_id');
    }

    public function scopeBudget($query, $budget)
    {
        return $query->where('budget_id', $budget->id);
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
