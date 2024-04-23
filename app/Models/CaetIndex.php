<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CaetIndex extends Model
{
    public function caetElement(): BelongsTo
    {
        return $this->belongsTo(CaetElement::class);
    }

    public function caetScales(): HasMany
    {
        return $this->hasMany(CaetScale::class);
    }
}
