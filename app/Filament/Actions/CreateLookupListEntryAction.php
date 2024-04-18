<?php

namespace App\Filament\Actions;

use Filament\Actions\CreateAction;
use Filament\Facades\Filament;

class CreateLookupListEntryAction extends CreateAction
{
    protected function setUp(): void
    {
        parent::setUp();

        // add the current team as owner
        if (Filament::hasTenancy()) {
            $this->mutateFormDataUsing(
                fn (array $data): array => collect($data)->put('owner_id', Filament::getTenant()->id)
                ->put('owner_type', get_class(Filament::getTenant()))
                ->toArray()
            );
        }

    }

}
