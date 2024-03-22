<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Import extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function casts(): array
    {
        return [
            'success' => 'boolean',
            'errors' => 'collection',
        ];
    }

    public function modelType(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Str::of($value)->afterLast('\\')->plural();
            },
        );
    }

    public function fileName(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->getFirstMedia()?->file_name;
            },
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
