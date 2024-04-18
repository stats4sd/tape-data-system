<?php

namespace App\Models\Interfaces;

interface LookupListEntry
{
    public static function getLinkedDataset(): ?\App\Models\Dataset;

    public function isGlobalEntry(): \Illuminate\Database\Eloquent\Casts\Attribute;

    public function isGlobal(): bool;

    public function isCustomisedEntry(): \Illuminate\Database\Eloquent\Casts\Attribute;

    public function isCustomised(): bool;

    public function owner(): \Illuminate\Database\Eloquent\Relations\MorphTo;

}
