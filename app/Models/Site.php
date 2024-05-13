<?php

namespace App\Models;

use App\Models\SampleFrame\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
