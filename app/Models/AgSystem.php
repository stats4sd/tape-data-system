<?php

namespace App\Models;

use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\HasProperties;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AgSystem extends Model implements HasMedia
{
    use HasLinkedDataset;
    use HasProperties;
    use InteractsWithMedia;

    protected bool $propertiesAreCompletable = true;

    protected $casts = [
        'properties' => 'collection',
    ];

    protected static function booted()
    {
        // when created, setup the 'variable_complete' properties
        static::created(function (self $agSystem) {

            $dataset = self::getLinkedDataset();

            if(!$dataset) {
                return;
            }

            $updatedProps = $dataset->variables->mapWithKeys(function ($variable) {
                return [$variable->name . '_complete' => false];
            });

            $agSystem->updateProps($updatedProps->toArray());
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

}
