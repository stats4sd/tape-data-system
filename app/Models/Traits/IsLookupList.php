<?php

namespace App\Models\Traits;

use App\Models\Team;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->team_id === null;
    }

    public function isCustomisedEntry(): Attribute
    {
        return new Attribute(
            get: fn (): bool => $this->isCustomised(),
        );
    }

    public function isCustomised(): bool
    {
        return $this->team_id !== null;
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
