<?php

namespace App\Models\LookupTables;

class Animal extends LookupEntry
{
//    protected static function booted(): void
//    {
//        parent::booted();
//    }

    public function getCsvContentsForOdk(): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
