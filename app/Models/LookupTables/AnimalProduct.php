<?php

namespace App\Models\LookupTables;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Illuminate\Database\Eloquent\Model;

class AnimalProduct extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;
}
