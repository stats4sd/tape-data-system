<?php

namespace App\Models\LookupTables;

use App\Models\Team;
use App\Models\Traits\HasLinkedDataset;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Crop extends Model
{
    use HasLinkedDataset;

    protected static function booted()
    {
        // if using filament tenancy, only return records for the current team (or all teams)

        static::addGlobalScope('team', function ($builder) {
            if (!Filament::hasTenancy()) {
                return;
            }

            $builder->where('team_id', Filament::getTenant()->id)->orWhere('team_id', null);
        });
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
