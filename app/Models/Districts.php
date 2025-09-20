<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Districts withoutTrashed()
 * @mixin \Eloquent
 */
class Districts extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
    ];
}
