<?php

namespace App\Models\SampleFrame;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Team;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class LocationLevel extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

    protected static function booted(): void
    {
        static::saving(function (self $locationLevel) {
            $locationLevel->slug = $locationLevel->slug ?? Str::slug($locationLevel->name);
        });

        if(Filament::hasTenancy() && Filament::getTenant() instanceof Team) {
            static::addGlobalScope('team', function ($query) {
                $query->where('owner_id', Filament::getTenant()->id);
            });
        }
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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

    // the position of the location level in the hierarchy based on the owning team.
    // This is used to find the correct location level to use in the ODK form's repeat group for locations. (NOTE - this assumes that there is a single hierarchy of location levels. Currently untested with more complex setups!)
    public function getPos(): int
    {

        $position = 1;
        $level = $this;

        while ($level->parent_id) {
            $level = $level->parent;
            $position++;
        }

        return $position;

    }

    public function pos(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getPos(),
        );
    }

    public function getCsvContentsForOdk(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'pos' => $this->pos,
            'has_farms' => $this->has_farms,
        ];
    }
}
