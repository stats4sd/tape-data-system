<?php

namespace App\Models\LookupTables;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Team;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CropProduct extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getCsvContentsForOdk(): array
    {
        // TODO: Implement getCsvContentsForOdk() method.
    }
}
