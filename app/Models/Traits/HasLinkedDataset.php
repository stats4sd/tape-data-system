<?php

namespace App\Models\Traits;

use App\Models\Dataset;

/**
 * Interface to use for models that have a 'main' linked dataset.
 */
trait HasLinkedDataset
{

    public static function getLinkedDataset(): ?Dataset
    {
        return Dataset::where('entity_model', self::class)
            ->orWhere('entity_model', '\\' . self::class)
            ->first();
    }

}
