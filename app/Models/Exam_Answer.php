<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $exam_id
 * @property int $question_id
 * @property int|null $option_id
 * @property string|null $essay_answer
 * @property int|null $score
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exam $exam
 * @property-read \App\Models\Question_Option|null $option
 * @property-read \App\Models\Package_question $packageQuestion
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereEssayAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam_Answer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Exam_Answer extends Model
{
    use HasFactory;
    protected $table = 'exam_answers';
    protected $fillable = [
        'exam_id',
        'question_id',
        'option_id',
        'essay_answer',
        'score',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(Question_Option::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function packageQuestion()
{
    return $this->belongsTo(Package_Question::class, 'question_id'); // Pastikan foreign key benar
}
}
