<?php

namespace App\Models\LookupTables;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use App\Models\UnitType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

    public function unitType(): BelongsTo
    {
        return $this->belongsTo(UnitType::class);
    }

    public function getCsvContentsForOdk(): array
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
