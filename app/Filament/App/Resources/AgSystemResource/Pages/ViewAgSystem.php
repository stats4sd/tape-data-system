<?php

namespace App\Filament\App\Resources\AgSystemResource\Pages;

use App\Filament\App\Resources\AgSystemResource;
use App\Services\HelperService;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAgSystem extends ViewRecord
{
    protected static string $resource = AgSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit'),
        ];
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [];

        $site = $this->record->site;

        $tenant = HelperService::getSelectedTeam()->id;

        $breadcrumbs[route('filament.app.resources.sites.view', ['tenant' => $tenant, 'record' => $site->id])] = 'Site';

        $breadcrumbs[route('filament.app.resources.ag-systems.view', ['tenant' => $tenant, 'record' => $this->record->id])] = 'View Agricultural System';

        return $breadcrumbs;
    }
}
