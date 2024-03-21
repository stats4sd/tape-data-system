<?php

namespace App\Models\SampleFrame;

use App\Models\Team;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Location extends Model
{
    protected $casts = [
        'properties' => 'collection',
    ];

    protected $touches = [
        'parent',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function locationLevel(): BelongsTo
    {
        return $this->belongsTo(LocationLevel::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function farms()
    {
        return $this->hasMany(Farm::class);
    }

    // Only the lower level locations have sample units (in this case, farms). E.g. A "district" may not have farms directly attached. But a "village" might.
    public function hasFarms(): Attribute
    {
        return new Attribute(
            get: fn (): bool => $this->locationLevel?->has_households ?? false,
        );
    }

    // TODO: consider refactoring this to avoid recursion down through the levels. It gets a bit slow when calling for a location at 3 levels, and might be unmanagaable at 4+ levels.

    // Counts all farms within this location *and* all children locations - e.g. to get the total number of farms in a district, we find all the locations within the district, and then count all the farms in those locations.
    public function farmsAllCount(): Attribute
    {
        return new Attribute(
            get: function () {
                return Cache::remember($this->cacheKey().':farmsAllCount', now()->addMinutes(5), function () {
                    return $this->children->reduce(function ($carry, $location) {
                        return $carry + $location->farmsAllCount;
                    }, $this->farms->count());
                });
            }
        );
    }

    // from https://laravel-news.com/laravel-model-caching
    public function cacheKey(): string
    {
        return sprintf(
            '%s/%s-%s',
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp
        );
    }
}
