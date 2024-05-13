<?php

namespace App\Models\SampleFrame;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FarmGroup extends Model
{

    public function owner(): MorphTo
    {
        return $this->morphTo('owner');
    }

    public function farms(): BelongsToMany
    {
        return $this->belongsToMany(Farm::class);
    }

    public function farmGrouping(): BelongsTo
    {
        return $this->belongsTo(FarmGrouping::class);
    }

}
