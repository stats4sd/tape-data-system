<?php

namespace App\Models\Interfaces;

interface LookupListEntry
{
    public function isGlobalEntry(): \Illuminate\Database\Eloquent\Casts\Attribute;

    public function isGlobal(): bool;

    public function isCustomisedEntry(): \Illuminate\Database\Eloquent\Casts\Attribute;

    public function isCustomised(): bool;

    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo;

}
