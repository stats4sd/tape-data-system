<?php

namespace App\Models\LookupTables;

use App\Models\Team;
use App\Models\Traits\HasLinkedDataset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalProduct extends Model
{
    use HasLinkedDataset;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
