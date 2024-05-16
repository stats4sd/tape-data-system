<?php

namespace App\Models;

use App\Models\SampleFrame\Farm;
use App\Models\SampleFrame\Location;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends \Stats4sd\FilamentOdkLink\Models\OdkLink\Submission
{
    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class, 'farm_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function xlsform(): BelongsTo
    {
        return $this->belongsTo(Xlsform::class, 'xlsform_id');
    }

}
