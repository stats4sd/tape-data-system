<?php

namespace App\Models\LookupTables;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Traits\HasLinkedDataset;
use App\Models\Traits\IsLookupList;
use Illuminate\Database\Eloquent\Model;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

// Generic Class for models that are entries in a lookup table (i.e. they are linked to a dataset that will be used to create csv files for ODK media attachments).

class LookupEntry extends Model implements LookupListEntry
{
    use HasLinkedDataset;
    use IsLookupList;

    protected static function booted(): void
    {
        static::saved(static function (LookupEntry $model) {
            // if the linked dataset is linked to any xlsforms that are *live*, then those forms should be marked as needing a media update
            $linkedDataset = $model->getLinkedDataset();
            if ($linkedDataset) {
                $linkedDataset->markLiveXlsformsWithMediaUpdate();
            }

        });
    }

    // Set default. This is overwritten by the CanBeHiddenFromContext trait in some cases.
    public static function canBeHiddenFromContext(): bool
    {
        return false;
    }

    // Generic CSV content. Should be overwritten by specific classes when the csv file contents needs to be specific.
    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
