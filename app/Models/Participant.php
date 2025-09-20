<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Tables\Columns\ImageColumn;

/**
 * @property int $id
 * @property string $name
 * @property string $nik
 * @property string $place_of_birth
 * @property string $date_of_birth
 * @property string $gender
 * @property string $religion
 * @property int $village_id
 * @property string $telp
 * @property string $email
 * @property string $address
 * @property string|null $image
 * @property string $slug
 * @property int $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Village $village
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereVillageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant withoutTrashed()
 * @mixin \Eloquent
 */
class Participant extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'nik',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'email',
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $model->slug = Str::random(10);
            } while (static::where('slug', $model->slug)->exists());
        });
    }
}
