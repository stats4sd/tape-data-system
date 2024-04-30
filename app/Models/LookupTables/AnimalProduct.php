<?php

namespace App\Models\LookupTables;

class AnimalProduct extends LookupEntry
{
    public function getCsvContentsForOdk(): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
