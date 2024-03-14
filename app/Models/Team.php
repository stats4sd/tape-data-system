<?php

namespace App\Models;

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

}
