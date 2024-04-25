<?php

namespace App\Models\LookupTables;

class Animal extends LookupEntry
{
    protected static function booted(): void
    {
        parent::booted();

        static::saved(static function (Animal $animal) {
            ray('RUNNING ON ANIMAL MODEL - Saved entry for animal - ' . $animal->id);
        });
    }

    public function getCsvContentsForOdk(): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
