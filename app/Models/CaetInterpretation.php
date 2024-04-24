<?php

namespace App\Models;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaetInterpretation extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

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

    public function getCsvContentsForOdk(): array
    {

        return [
            'id'  => $this->id,
            'xlsform_name' => $this->caetIndex?->xlsform_name,
            'interpretation' => $this->interpretation,
        ];
    }
}
