<?php

namespace App\Models\SampleFrame;

use App\Models\Team;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class LocationLevel extends Model
{
    protected static function booted(): void
    {
        static::saving(function (self $locationLevel) {
            $locationLevel->slug = $locationLevel->slug ?? Str::slug($locationLevel->name);
        });

        if(Filament::hasTenancy()) {
            static::addGlobalScope('team', function ($query) {
                $query->where('team_id', Filament::getTenant()->id);
            });
        }
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
