<?php

namespace App\Models;

use App\Models\SampleFrame\Farm;
use App\Models\LookupTables\Crop;
use App\Models\LookupTables\Animal;
use App\Models\SampleFrame\Location;
use App\Models\SampleFrame\FarmGroup;
use App\Models\LookupTables\CropProduct;
use App\Models\SampleFrame\FarmGrouping;
use App\Models\SampleFrame\LocationLevel;
use App\Models\LookupTables\AnimalProduct;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends \Stats4sd\FilamentOdkLink\Models\TeamManagement\Team
{
    // TODO: I think this overrides the booted method on HasXlsForms - ideally we wouldn't need to copy the package stuff here...
    protected static function booted(): void
    {

        // when the model is created; automatically create an associated project on ODK Central and a top location level;
        static::created(static function ($owner) {

            // check if we are in local-only (no-ODK link) mode
            $odkLinkService = app()->make(OdkLinkService::class);
            if (config('filament-odk-link.odk.url') !== null && config('filament-odk-link.odk.url') !== '') {
                $owner->createLinkedOdkProject($odkLinkService, $owner);
            }

            // create empty interpretation entries for the team:
            // TODO: this probably is not great, and we should not require a bunch of empty entries!

            $interpretations = CaetIndex::all()->map(fn ($index) => [
                'owner_id' => $owner->id,
                'owner_type' => static::class,
                'caet_index_id' => $index->id,
                'interpretation' => '',
            ])->toArray();

            $owner->caetInterpretations()->createMany($interpretations);

            $owner->locationLevels()->create(['name' => 'Site level - click edit to rename', 'has_farms' => 0, 'top_level' => 1, 'slug' =>'site-level']);

        });


    }


    // Get the current step of the survey process for a team:
    public function currentStep(): int
    {
        // TODO - update:
        return 0;

    }

    public function farms(): MorphMany
    {
        return $this->morphMany(Farm::class, 'owner');
    }

    public function farmGroups(): MorphMany
    {
        return $this->morphMany(FarmGroup::class, 'owner');
    }

    public function farmGroupings(): MorphMany
    {
        return $this->morphMany(FarmGrouping::class, 'owner');
    }

    public function sites(): HasMany
    {
        return $this->hasMany(Site::class);
    }

    public function locationLevels(): MorphMany
    {
        return $this->morphMany(LocationLevel::class, 'owner');
    }

    public function locations(): MorphMany
    {
        return $this->morphMany(Location::class, 'owner');
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

    public function animalsRemoved(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_team_removed');
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
