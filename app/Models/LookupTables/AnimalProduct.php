<?php

namespace App\Models\LookupTables;

use App\Models\Traits\CanBeHiddenFromContext;

class AnimalProduct extends LookupEntry
{
    use CanBeHiddenFromContext;

    public function getCsvContentsForOdk(): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
