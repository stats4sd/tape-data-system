<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Collection;

class Dataset extends \Stats4sd\FilamentOdkLink\Models\OdkLink\Dataset
{
    public function databaseTable(): Attribute
    {
        return new Attribute(
            get: fn (): string => $this->entity_model ? $this->entity_model::getTable() : '',
        );
    }

    public function globalEntries(): Attribute
    {
        return new Attribute(
            get: fn (): Collection => $this->entity_model::whereDoesntHave('team'),
        );
    }

    public function globalEntriesCount(): Attribute
    {
        return new Attribute(
            get: fn (): int => $this->entity_model::whereDoesntHave('team')->count(),
        );
    }

    public function teamEntries(): Attribute
    {
        return new Attribute(
            get: fn (): Collection => $this->entity_model::whereHas('team'),
        );
    }

    public function teamEntriesCount(): Attribute
    {
        return new Attribute(
            get: fn (): int => $this->entity_model::whereHas('team')->count(),
        );
    }
}
