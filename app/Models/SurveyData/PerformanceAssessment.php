<?php

namespace App\Models\SurveyData;

use App\Models\SampleFrame\Farm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceAssessment extends Model
{
    protected $table = 'performances';

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
