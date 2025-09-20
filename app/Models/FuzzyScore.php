<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $source_type 1=exam, 2=evaluation
 * @property int $source_id ID dari exam/evaluation
 * @property int $participant_id
 * @property int $criteria_id
 * @property int $formation_id
 * @property float $score
 * @property float $score_fuzzy
 * @property float|null $score_fuzzy_normalized
 * @property float|null $score_final
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereCriteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereFormationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereScoreFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereScoreFuzzy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereScoreFuzzyNormalized($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereSourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FuzzyScore whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FuzzyScore extends Model
{
    protected $table='fuzzy_scores';
    protected $fillable = [
        'source_type',
        'source_id',
        'participant_id',
        'criteria_id',
        'formation_id',
        'score',
        'score_fuzzy',
        'score_fuzzy_normalized',
        'score_final',
       
    ];
}
