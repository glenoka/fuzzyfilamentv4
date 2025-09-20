<?php

namespace App\Models;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $criteria_id
 * @property int $formation_id
 * @property string $type_package
 * @property int $duration
 * @property float $max_score
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Criteria|null $criteria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exam
 * @property-read int|null $exam_count
 * @property-read \App\Models\Formation $formation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Package_question> $package_questions
 * @property-read int|null $package_questions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereCriteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereFormationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereMaxScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereTypePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package withoutTrashed()
 * @mixin \Eloquent
 */
class Package extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'duration',
        'type_package',
        'kategory',
        'formation_id',
        'criteria_id',
        'score_max',

    ];


    public function package_questions(): HasMany
{
    return $this->hasMany(Package_question::class);
}
public function criteria(): BelongsTo
{
    return $this->belongsTo(Criteria::class);
}
public function formation(): BelongsTo
{
    return $this->belongsTo(Formation::class);
}
public function exam(): HasMany
{
    return $this->hasMany(Exam::class);
}
}