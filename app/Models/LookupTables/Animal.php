<?php

namespace App\Models\LookupTables;

use App\Models\Traits\CanBeHiddenFromContext;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Interfaces\WithXlsforms;

class Animal extends LookupEntry
{
    use CanBeHiddenFromContext;

    public function getCsvContentsForOdk(?WithXlsforms $team = null): array
    {
        if ($team) {
            $isRelevant = $this->isRemoved($team) ? 0 : 1;
        } else {
            $isRelevant = null;
        }

        return [
            'id'  => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'is_in_context' => $isRelevant,
            'raised_max' => $this->raised_max,
            'breeds_max' => $this->breeds_max,
            'born_max' => $this->born_max,
            'died_max' => $this->died_max,
            'slaughtered_max' => $this->slaughtered_max,
            'purchased_max' => $this->purchased_max,
            'sold_max' => $this->sold_max,
            'farmgate_max' => $this->farmgate_max,
            'given_max' => $this->given_max,
            'expenditures_feed_max' => $this->expenditures_feed_max,
            'expenditures_vet_max' => $this->expenditures_vet_max,
        ];
    }
}
