<?php

namespace App\Models\LookupTables;

use App\Models\Traits\CanBeHiddenFromContext;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class AnimalProduct extends LookupEntry
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
            'quantity_sold_max' => $this->quantity_sold_max,
            'farmgate_max' => $this->farmgate_max,
            'quantity_given_max' => $this->quantity_given_max,
        ];
    }
}
