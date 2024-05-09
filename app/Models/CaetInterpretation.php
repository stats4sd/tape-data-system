<?php

namespace App\Models;

use App\Models\LookupTables\LookupEntry;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class CaetInterpretation extends LookupEntry
{
    public function hasContextualisedInterpretation(): Attribute
    {
        return new Attribute(
            get: function (): bool {
                return $this->interpretation && $this->interpretation !== '';
            },
        );
    }

    public function caetIndex(): BelongsTo
    {
        return $this->belongsTo(CaetIndex::class);
    }


    // Caet interpretations are, by definition, always contextualised, and so always have an owner and are never 'global'.
    public function isGlobal(): bool
    {
        return false;
    }

    public function isCustomised(): bool
    {
        return true;
    }

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {

        return [
            'id'  => $this->id,
            'xlsform_name' => $this->caetIndex?->xlsform_name,
            'interpretation' => $this->interpretation,
        ];
    }
}
