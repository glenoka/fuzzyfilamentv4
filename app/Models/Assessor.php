<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $place_of_birth
 * @property string $date_of_birth
 * @property string $gender
 * @property string $religion
 * @property int $village_id
 * @property string $telp
 * @property string $email_assessor
 * @property string $address
 * @property string $image
 * @property int $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Village $village
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereEmailAssessor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor whereVillageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assessor withoutTrashed()
 * @mixin \Eloquent
 */
class Assessor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'email_assessor',
        'religion',
        'address',
        'village_id',
        'telp',
        'image',
        'user_id',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function village(){
        return $this->belongsTo(Village::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }

     public function practiceEvaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'assessor_id');
    }
}
