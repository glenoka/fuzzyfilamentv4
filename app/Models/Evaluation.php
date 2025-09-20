<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $assessor_id
 * @property int $participant_id
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Assessor $assessor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Evaluation_details> $evaluationDetails
 * @property-read int|null $evaluation_details_count
 * @property-read \App\Models\Participant $participant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation whereAssessorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Evaluation extends Model
{
    protected $fillable = [
        'assessor_id',
        'participant_id',
        'date',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function evaluationDetails()
    {
        return $this->hasMany(Evaluation_details::class, 'evaluation_id'); // Tambahkan foreign key
    }
    public function assessor()
    {
        return $this->belongsTo(Assessor::class, 'assessor_id');
    }
}
