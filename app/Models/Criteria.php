<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $criteria
 * @property string|null $description
 * @property int $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Package> $packages
 * @property-read int|null $packages_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria whereCriteria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Criteria whereValue($value)
 * @mixin \Eloquent
 */
class Criteria extends Model
{
   
    protected $fillable=[
        'name',
        'description',
        'value'
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
