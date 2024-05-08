<?php

namespace App\Models;

use App\Models\LookupTables\LookupEntry;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaetScale extends LookupEntry
{
    public function caetIndex(): BelongsTo
    {
        return $this->belongsTo(CaetIndex::class);
    }

    public function getCsvContentsForOdk(): array
    {
        return [
            'id' => $this->id,
            'xlsform_name' => $this->caetIndex?->xlsform_name,
            'score' => $this->score,
            'definition' => $this->definition,
        ];
    }
}
