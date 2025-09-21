<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $participant_id
 * @property int $package_id
 * @property int $duration
 * @property string $slug
 * @property int|null $total_score
 * @property int $assessor_id
 * @property string $started_at
 * @property string|null $finish_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam_Answer> $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Assessor $assessor
 * @property-read \App\Models\Package $package
 * @property-read \App\Models\Package_question|null $package_questions
 * @property-read \App\Models\Participant $participant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereAssessorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereFinishAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereTotalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam withoutTrashed()
 * @mixin \Eloquent
 */
class Exam extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'participant_id',
        'package_id',
        'duration',
        'started_at',
        'finish_at',
        'assessor_id',
        'total_score',

    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
  
    public function assessor()
    {
        return $this->belongsTo(Assessor::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    
    public function package_questions()
    {
        return $this->belongsTo(Package_question::class, 'question_id',);
    }

    public function answers()
    {
        return $this->hasMany(Exam_Answer::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $model->slug = Str::random(10);
            } while (static::where('slug', $model->slug)->exists());
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
