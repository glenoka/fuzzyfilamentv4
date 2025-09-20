<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Formation_Selection;

/**
 * @property int $id
 * @property int $participant_id
 * @property int $formation_id
 * @property float $total_score
 * @property int $rank
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Formation $formation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Formation_Selection> $formationSelection
 * @property-read int|null $formation_selection_count
 * @property-read \App\Models\Participant $participant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking whereFormationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking whereTotalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ranking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ranking extends Model
{
    use HasFactory;
    protected $fillable = [
        'participant_id',
        'formation_id',
        'total_score',
        'rank',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function formationSelection()
    {
        return $this->hasMany(Formation_Selection::class);
    }

    

}
