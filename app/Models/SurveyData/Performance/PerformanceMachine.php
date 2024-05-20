<?php

namespace App\Models\SurveyData\Performance;

use App\Models\Interfaces\PerformanceRepeatModel;
use App\Models\SurveyData\MainSurvey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;

class PerformanceMachine extends Model implements PerformanceRepeatModel
{
    public function mainSurvey(): BelongsTo
    {
        return $this->belongsTo(MainSurvey::class, 'submission_id', 'submission_id');
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class, 'submission_id', 'id');
    }
}
