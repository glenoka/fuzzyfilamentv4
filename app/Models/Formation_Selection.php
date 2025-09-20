<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $formation_id
 * @property int $participant_id
 * @property string $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Formation $formation
 * @property-read \App\Models\Participant $participant
 * @property-read \App\Models\Ranking $ranking
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection whereFormationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Formation_Selection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Formation_Selection extends Model
{
    use HasFactory;
    public $table='formation_selections';
    protected $fillable = [
        'formation_id',
        'participant_id',
        'status'
    ];

    public function formation(){
        return $this->belongsTo(Formation::class);
    }
    public function participant(){
        return $this->belongsTo(Participant::class, 'participant_id');
    }
    public function ranking()
    {
        return $this->belongsTo(Ranking::class,'participant_id','participant_id');
    }

    protected static function boot()
{
    parent::boot();

    static::saving(function ($model) {
        if (static::where('formation_id', $model->formation_id)
            ->where('participant_id', $model->participant_id)
            ->exists()
        ) {
            throw new \Exception('Participant sudah terdaftar di formasi ini');
        }
    });
}
        
}
