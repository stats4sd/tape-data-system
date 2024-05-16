<?php

namespace App\Models\SurveyData;

use App\Models\SampleFrame\Farm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * NOT CURRENTLY IN USE - until we work out how to auto-link different form sections at the same 'level' to different datasets
 */
class PerformanceAssessment extends Model
{
    protected $table = 'performances';

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
