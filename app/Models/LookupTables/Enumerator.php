<?php

namespace App\Models\LookupTables;

use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class Enumerator extends LookupEntry
{
    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
