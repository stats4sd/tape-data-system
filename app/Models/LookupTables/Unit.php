<?php

namespace App\Models\LookupTables;

use App\Models\UnitType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class Unit extends LookupEntry
{
    public function unitType(): BelongsTo
    {
        return $this->belongsTo(UnitType::class);
    }

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        return [
            'id'  => $this->id,
            'unit_type_id' => $this->unitType?->id,
            'unit_type_name' => $this->unitType?->name,
            'name' => $this->name,
            'label' => $this->label,
            'conversion_rate' => $this->conversion_rate,
        ];
    }
}
