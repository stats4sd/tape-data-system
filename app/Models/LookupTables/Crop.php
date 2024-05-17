<?php

namespace App\Models\LookupTables;

use App\Models\Traits\CanBeHiddenFromContext;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class Crop extends LookupEntry
{
    use CanBeHiddenFromContext;

    public function getExtraCsvRows(): array
    {
        return [
            [
                'id' => null,
                'name' => 77,
                'label' => "Other crops",
                'is_in_context' => 1,
            ],
            [
                'id' => null,
                'name' => 800,
                'label' => 'Other agave fibres',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 782,
                'label' => 'Other bastfibres',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 108,
                'label' => 'Other cereals',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 821,
                'label' => 'Other fibre crops',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 339,
                'label' => 'Other oilseeds',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 149,
                'label' => 'Other roots and tubers',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 161,
                'label' => 'Other sugar crops',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 777770,
                'label' => 'Other fruits',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 777771,
                'label' => 'Other vegetables',
                'is_in_context' => 0,
            ],
            [
                'id' => null,
                'name' => 77,
                'label' => 'Other crops (that do not fit into another category)',
                'is_in_context' => 0,
            ],

        ];

    }

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
            'sold_max' => $this->sold_max,
            'farmgate_max' => $this->farmgate_max,
            'gift_max' => $this->gift_max,
            'land_use_max' => $this->land_use_max,
            'varieties_max' => $this->varieties_max,
        ];
    }
}
