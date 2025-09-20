<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $section_id
 * @property string $task
 * @property int $max_score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Evaluation_details> $evaluation_details
 * @property-read int|null $evaluation_details_count
 * @property-read \App\Models\Section $section
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect whereMaxScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect whereTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Aspect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Aspect extends Model
{
    protected $fillable = [
        'section_id',
        'task',
        'max_score',
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function evaluation_details()
    {
        return $this->hasMany(Evaluation_details::class);
    }
}
