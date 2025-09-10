<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        'name',
    ];

    public function aspects():HasMany {
        return $this->hasMany(Aspect::class);
    }
}
