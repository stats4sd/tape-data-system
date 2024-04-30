<?php

namespace App\Models\LookupTables;

use App\Models\Team;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Crop extends LookupEntry
{


    public function getCsvContentsForOdk(): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
