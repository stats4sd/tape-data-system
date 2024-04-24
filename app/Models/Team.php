<?php

namespace App\Models;

use App\Models\LookupTables\Animal;
use App\Models\LookupTables\AnimalProduct;
use App\Models\LookupTables\Crop;
use App\Models\LookupTables\CropProduct;
use App\Models\SampleFrame\Farm;
use App\Models\SampleFrame\Location;
use App\Models\SampleFrame\LocationLevel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class Team extends \Stats4sd\FilamentOdkLink\Models\TeamManagement\Team
{
    // TODO: I think this overrides the booted method on HasXlsForms - ideally we wouldn't need to copy the package stuff here...
    protected static function booted(): void
    {
        // check if we are in local-only (no-ODK link) mode
        if (config('filament-odk-link.odk.url') === null || config('filament-odk-link.odk.url') == '') {
            return;
        }

        $odkLinkService = app()->make(OdkLinkService::class);

        // when the model is created; automatically create an associated project on ODK Central;
        static::created(static function ($owner) use ($odkLinkService) {

            // check if we are in local-only (no-ODK link) mode
            if (config('filament-odk-link.odk.url') !== null && config('filament-odk-link.odk.url') !== '') {
                $owner->createLinkedOdkProject($odkLinkService, $owner);
            }

            // create empty interpretation entries for the team:
            // TODO: this probably is not great, and we should not require a bunch of empty entries!

            $interpretations = CaetIndex::all()->map(fn ($index) => [
                'team_id' => $owner->id,
                'caet_index_id' => $index->id,
                'interpretation' => '',
            ])->toArray();

            $owner->caetInterpretations()->createMany($interpretations);


        });


    }


    // Get the current step of the survey process for a team:
    public function currentStep(): int
    {
        // TODO - update:
        return 0;

    }

    public function farms(): HasMany
    {
        return $this->hasMany(Farm::class);
    }

    public function sites(): HasMany
    {
        return $this->hasMany(Site::class);
    }

    public function locationLevels(): HasMany
    {
        return $this->hasMany(LocationLevel::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function imports(): HasMany
    {
        return $this->hasMany(Import::class);
    }

    public function caetInterpretations(): MorphMany
    {
        return $this->morphMany(CaetInterpretation::class, 'owner');
    }

    // lookup tables

    public function animals(): MorphMany
    {
        return $this->morphMany(Animal::class, 'owner');
    }

    public function animalProducts(): MorphMany
    {
        return $this->morphMany(AnimalProduct::class, 'owner');
    }

    public function crops(): MorphMany
    {
        return $this->morphMany(Crop::class, 'owner');
    }

    public function cropProducts(): MorphMany
    {
        return $this->morphMany(CropProduct::class, 'owner');
    }

    public function lookupTables(): BelongsToMany
    {
        return $this->belongsToMany(Dataset::class, 'team_lookup_tables', 'team_id', 'lookup_table_id')
            ->withPivot('is_complete')
            ->where('lookup_table', true);
    }

    public function markLookupListAsComplete($lookupTable): ?bool
    {
        $dataset = $this->lookupTables()->sync([$lookupTable->id => ['is_complete' => 1]], detaching: false);

        return $this->hasCompletedLookupList($lookupTable);
    }

    public function markLookupListAsInComplete($lookupTable): ?bool
    {
        $dataset = $this->lookupTables()->sync([$lookupTable->id => ['is_complete' => 0]], detaching: false);

        return $this->hasCompletedLookupList($lookupTable);
    }

    public function hasCompletedLookupList($lookupTable): ?bool
    {
        return $this->lookupTables->where('id', $lookupTable->id)->first()?->pivot->is_complete;
    }

}
