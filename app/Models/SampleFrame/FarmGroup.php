<?php

namespace App\Models\SampleFrame;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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

}
