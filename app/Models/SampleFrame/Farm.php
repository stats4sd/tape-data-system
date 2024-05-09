<?php

namespace App\Models\SampleFrame;

use App\Models\LookupTables\LookupEntry;
use App\Models\Site;
use App\Models\SurveyData\CaetAssessment;
use App\Models\SurveyData\PerformanceAssessment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

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

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        return [
            'id'  => $this->id,
            'location_id' => $this->location_id,
            'location_name' => $this->location?->name,
            'team_code' => $this->team_code,
            'name' => $this->identifiers ? $this->identifiers['name'] : '',
            'sex' => $this->properties ? $this->properties['sex'] : '',
            'year' => $this->properties ? $this->properties['year'] : '',
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
