<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $evaluation_id
 * @property int $aspect_id
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Aspect $aspect
 * @property-read \App\Models\Evaluation $evaluation
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details whereAspectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details whereEvaluationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation_details whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Evaluation_details extends Model
{
    protected $table = 'evaluation_details';
    protected $fillable = [
        'evaluation_id',
        'aspect_id',
        'score',
    ];

    public function evaluation()
{
    return $this->belongsTo(Evaluation::class, 'evaluation_id'); // ✅
}

    public function aspect()
    {
        return $this->belongsTo(Aspect::class);
    }
}
