<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaetScale extends Model
{
    public function caetIndex(): BelongsTo
    {
        return $this->belongsTo(CaetIndex::class);
    }
}
