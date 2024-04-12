<?php

namespace App\Models;

use App\Models\LookupTables\Animal;
use App\Models\LookupTables\AnimalProduct;
use App\Models\LookupTables\Crop;
use App\Models\LookupTables\CropProduct;
use App\Models\SampleFrame\Farm;
use App\Models\SampleFrame\Location;
use App\Models\SampleFrame\LocationLevel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends \Stats4sd\FilamentOdkLink\Models\TeamManagement\Team
{
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

    // lookup tables

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    public function animalProducts(): HasMany
    {
        return $this->hasMany(AnimalProduct::class);
    }

    public function crops(): HasMany
    {
        return $this->hasMany(Crop::class);
    }

    public function cropProducts(): HasMany
    {
        return $this->hasMany(CropProduct::class);
    }


}
