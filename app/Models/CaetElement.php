<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

// The list of AE Elements that CAET is based on
class CaetElement extends Model
{
    public function caetIndices(): HasMany
    {
        return $this->hasMany(CaetIndex::class);
    }

    public function caetScales(): HasManyThrough
    {
        return $this->hasManyThrough(CaetScale::class, CaetIndex::class);
    }
}
