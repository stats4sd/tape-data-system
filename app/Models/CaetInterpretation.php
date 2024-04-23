<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaetInterpretation extends Model
{
    public function hasContextualisedInterpretation(): Attribute
    {
        return new Attribute(
            get: function (): bool {
                return $this->interpretation && $this->interpretation !== '';
            },
        );
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function caetIndex(): BelongsTo
    {
        return $this->belongsTo(CaetIndex::class);
    }
}
