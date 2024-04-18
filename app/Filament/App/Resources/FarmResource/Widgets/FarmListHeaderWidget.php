<?php

namespace App\Filament\App\Resources\FarmResource\Widgets;

use App\Services\HelperService;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class FarmListHeaderWidget extends Widget
{
    protected static string $view = 'filament.app.resources.farm-resource.widgets.farm-list-header-widget';

    protected int|string|array $columnSpan = 'full';

    // check if there are locations at the correct admin level for farms to be linked.
    public function hasLocations(): bool
    {
        return HelperService::getSelectedTeam()?->locations()->whereHas('locationLevel', fn (Builder $query): Builder => $query->where('has_farms', true))->exists();
    }


}
