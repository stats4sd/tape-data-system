<?php

namespace App\Models\SampleFrame;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FarmGrouping extends Model
{

    public function owner(): MorphTo
    {
        return $this->morphTo('owner');
    }

    public function farmGroups(): HasMany
    {
        return $this->HasMany(FarmGroup::class);
    }

}
