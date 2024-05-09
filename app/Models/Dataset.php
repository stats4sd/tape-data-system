<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Stats4sd\FilamentOdkLink\Models\OdkLink\RequiredMedia;

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

    // Relationship for lookup tables?
    public function teamLookupTables(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_lookup_tables', 'lookup_table_id', 'team_id')
            ->withPivot('is_complete');
    }

    // calculates if the current team has completed the lookup table
    public function lookupIsComplete(): Attribute
    {
        if(Filament::hasTenancy()) {
            return new Attribute(
                get: fn (): bool => $this->teamLookupTables->where('team_id', Filament::getTenant()->id)->first()->is_complete ?? false,
            );
        } else {
            return new Attribute(
                get: fn () => null,
            );
        }
    }

    public function markLiveXlsformsWithMediaUpdate()
    {
        $this->requiredMedia
            ->each(function (RequiredMedia $media) {

                $media->xlsformTemplate->xlsforms()
                    ->where('is_active', true)
                    ->update(['has_latest_media' => false]);
            });
    }
}
