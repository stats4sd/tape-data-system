<?php

namespace App\Models\LookupTables;

use App\Models\Traits\CanBeHiddenFromContext;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class CropProduct extends LookupEntry
{
    use CanBeHiddenFromContext;

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        if ($team) {
            $isRelevant = $this->isRemoved($team) ? 0 : 1;
        } else {
            $isRelevant = null;
        }

        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'is_in_context' => $isRelevant,
            'total_max' => $this->total_max,
            'unit_default' => $this->unit_default,
            'sold_max' => $this->sold_max,
            'farmgate_max' => $this->farmgate_max,
            'given_max' => $this->given_max,
        ];
    }
}
