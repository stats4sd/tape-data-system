<?php

namespace App\Models;

use App\Models\SurveyData\CaetAssessment;
use App\Models\SurveyData\PerformanceAssessment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{

    protected $casts = [
        'identifiers' => 'collection',
        'properties' => 'collection',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function caetAssessments(): HasMany
    {
        return $this->hasMany(CaetAssessment::class);
    }

    public function performanceAssessments(): HasMany
    {
        return $this->hasMany(PerformanceAssessment::class);
    }
}
