<?php

namespace App\Models;

use App\Models\SampleFrame\Farm;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use App\Models\SampleFrame\Location;
use App\Models\Traits\HasProperties;
use App\Models\Traits\HasLinkedDataset;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgSystem extends Model implements HasMedia
{
    use HasLinkedDataset;
    use HasProperties;
    use InteractsWithMedia;

    protected bool $propertiesAreCompletable = true;

    protected $casts = [
        'properties' => 'collection',
        'properties_complete' => 'collection',
    ];

    protected static function booted()
    {
        // when created, setup the 'variable_complete' properties
        static::created(function (self $agSystem) {

            $dataset = self::getLinkedDataset();

            if(!$dataset) {
                return;
            }

            $props = $dataset->variables->mapWithKeys(function ($variable) {
                return [$variable->name => ''];
            });

            $agSystem->updateProperties($props->toArray());


        });
    }

    public function registerMediaCollections(): void
    {
        $dataset = self::getLinkedDataset();

        if (!$dataset) {
            return;
        }

        foreach ($dataset->variables as $variable) {
            $this->addMediaCollection($variable->name);
        }
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function farms(): HasMany
    {
        return $this->hasMany(Farm::class);
    }

}
