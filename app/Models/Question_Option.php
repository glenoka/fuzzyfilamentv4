<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $question_id
 * @property string $option_text
 * @property int $score
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option whereOptionText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question_Option whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question_Option extends Model
{
    use HasFactory;
    protected $table = 'question_options';
    protected $fillable = [
        'question_id',
        'option_text',
        'score'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    
}
