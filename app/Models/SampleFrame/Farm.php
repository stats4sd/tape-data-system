<?php

namespace App\Models\SampleFrame;

use App\Models\AgSystem;
use App\Models\Interfaces\LookupListEntry;
use App\Models\SurveyData\CaetAssessment;
use App\Models\SurveyData\PerformanceAssessment;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Farm extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

    protected $casts = [
        'identifiers' => 'collection',
        'properties' => 'collection',
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo('owner');
    }

    public function agSystem(): BelongsTo
    {
        return $this->belongsTo(AgSystem::class);
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
}
