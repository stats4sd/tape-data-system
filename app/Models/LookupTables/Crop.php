<?php

namespace App\Models\LookupTables;

use App\Models\Traits\CanBeHiddenFromContext;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class Crop extends LookupEntry
{
    use CanBeHiddenFromContext;

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'is_in_context' => $team ? $this->isRemoved($team) : null,

        ];
    }
}
