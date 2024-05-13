<?php

namespace App\Models\SampleFrame;

use App\Models\LookupTables\LookupEntry;
use App\Models\Site;
use App\Models\SurveyData\CaetAssessment;
use App\Models\SurveyData\PerformanceAssessment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function farmGroups(): BelongsToMany
    {
        return $this->belongsToMany(FarmGroup::class);
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
            'team_code_name' => $this->identifiers ? $this->identifiers['name'] . '(No. ' . $this->team_code . ')' : 'No. ' . $this->team_code,
            'name' => $this->identifiers ? $this->identifiers['name'] : '',
            'sex' => $this->properties ? $this->properties['sex'] : '',
            'year' => $this->properties ? $this->properties['year'] : '',
            'reserve' => $this->identifiers ? $this->identifiers['reserve'] : '', // value is 0 = beneficiary farm that is not a reserve; 1 = beneficiary farm that is a reserve; '' = non-beneficiary farm.
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
