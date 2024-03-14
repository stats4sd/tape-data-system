<?php

namespace App\Models\SurveyData\Performance;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceMachine extends Model
{
        public function performanceAssessment(): BelongsTo
    {
        return $this->belongsTo(PerformanceAssessment::class);
    }
}
