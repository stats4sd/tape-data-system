<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait IsLookupList
{
    // is the current entry a 'global' entry?
    public function isGlobalEntry(): Attribute
    {
        return new Attribute(
            get: fn (): bool => $this->isGLobal(),
        );
    }

    public function isGlobal(): bool
    {
        return $this->owner_id === null;
    }

    public function isCustomisedEntry(): Attribute
    {
        return new Attribute(
            get: fn (): bool => $this->isCustomised(),
        );
    }

    public function isCustomised(): bool
    {
        return $this->owner_id !== null;
    }

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    // get the column names for the ODK csv file (use the keys from the getCsvContentsForOdk method)
    public static function getColumnsForOdk(): array
    {
        return collect((new static())->getCsvContentsForOdk())->keys()->toArray();
    }

}
