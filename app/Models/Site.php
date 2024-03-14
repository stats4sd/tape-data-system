<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function aeZone(): BelongsTo
    {
        return $this->belongsTo(AeZone::class);
    }

    public function agSystems(): HasMany
    {
        return $this->hasMany(AgSystem::class);
    }

}
