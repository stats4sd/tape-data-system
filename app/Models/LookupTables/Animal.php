<?php

namespace App\Models\LookupTables;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

    public function getCsvContentsForOdk(): array
    {
        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
