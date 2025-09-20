<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $package_id
 * @property int $question_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Package $package
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package_question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Package_question extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'question_id', 
    ];
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
}
