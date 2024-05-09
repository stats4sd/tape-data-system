<?php

namespace App\Models;

use App\Models\LookupTables\LookupEntry;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class CaetScale extends LookupEntry
{
    public function caetIndex(): BelongsTo
    {
        return $this->belongsTo(CaetIndex::class);
    }

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        return [
            'id' => $this->id,
            'xlsform_name' => $this->caetIndex?->xlsform_name,
            'score' => $this->score,
            'definition' => $this->definition,
        ];
    }
}
