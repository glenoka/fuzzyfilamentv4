<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $village_id
 * @property string $district_id
 * @property string $due_date
 * @property string $status
 * @property string $education_level
 * @property string $open_position
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Districts|null $district
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Package> $packages
 * @property-read int|null $packages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Formation_Selection> $selections
 * @property-read int|null $selections_count
 * @property-read \App\Models\Village|null $village
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereEducationLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereOpenPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation whereVillageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation withoutTrashed()
 * @mixin \Eloquent
 */
class Formation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'village_id',
        'district_id',
        'due_date',
        'status',
        'education_level',
        'open_position',

    ];

    public function selections(){
        return $this->hasMany(Formation_Selection::class);
    }
    public function packages(){
        return $this->hasMany(Package::class);
    }
    public function village(){
        return $this->belongsTo(Village::class);
    }
    public function district(){
        return $this->belongsTo(Districts::class);
    }
}
