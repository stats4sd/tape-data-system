<?php

namespace App\Models\SampleFrame;

use App\Models\LookupTables\LookupEntry;
use App\Models\Site;
use App\Models\SurveyData\CaetAssessment;
use App\Models\SurveyData\PerformanceAssessment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Farm extends LookupEntry
{
    protected $casts = [
        'identifiers' => 'collection',
        'properties' => 'collection',
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo('owner');
    }

    public function caetAssessments(): HasMany
    {
        return $this->hasMany(CaetAssessment::class);
    }

    public function performanceAssessments(): HasMany
    {
        return $this->hasMany(PerformanceAssessment::class);
    }

    public function getCsvContentsForOdk(): array
    {
        return [
            'id'  => $this->id,
            'location_id' => $this->location_id,
            'location_name' => $this->location?->name,
            'team_code' => $this->team_code,
            'label' => $this->label,
        ];
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
