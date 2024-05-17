<?php

namespace App\Models\LookupTables;

use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class Enumerator extends LookupEntry
{
        public function getExtraCsvRows(): array
    {
        return [
            [
                'id' => null,
                'name' => 77,
                'label' => 'Name not on the list / other',
            ],
        ];
    }

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
