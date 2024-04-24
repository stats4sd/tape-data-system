<?php

namespace App\Models;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaetScale extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

    public function caetIndex(): BelongsTo
    {
        return $this->belongsTo(CaetIndex::class);
    }

    public function getCsvContentsForOdk(): array
    {
        return [
            'id' => $this->id,
            'xlsform_name' => $this->caetIndex?->xlsform_name,
            'score' => $this->score,
            'definition' => $this->definition,
        ];
    }
}
