<?php

namespace App\Filament\App\Resources\AgSystemResource\Pages;

use App\Filament\App\Resources\AgSystemResource;
use App\Models\AgSystem;
use App\Services\HelperService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditAgSystem extends EditRecord
{
    protected static string $resource = AgSystemResource::class;

    // protected ?string $heading = 'Step 0 - Agricultural System Information';
    protected ?string $subheading = 'Add or edit information about the agricultural system. This will provide context for the survey data you collect.';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('delete_agystem')
                ->label('Delete agricultural system')
                ->action(function (): void {
                    $this->record->delete();
                    $this->redirectRoute(
                        'filament.app.resources.sites.view',
                        ['tenant' => HelperService::getSelectedTeam()->id, 'record' => $this->record->site_id]
                    );
                })
                ->successNotification(
                   Notification::make()
                        ->success()
                        ->title('Agricultural system deleted')
                )
        ];
    }

    public function getHeading(): string | Htmlable
    {
        return $this->getRecord()->name;
    }

    protected function handleRecordUpdate(AgSystem|Model $record, array $data): AgSystem
    {
        // most fields are for the properties json

        // remove fields that are *not* for properties:
        $name = $data['name'];

        unset($data['name']);


        $record->updateProperties($data);

        return $record;

    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [];

        $site = $this->record->site;

        $tenant = HelperService::getSelectedTeam()->id;

        $breadcrumbs[route('filament.app.resources.sites.view', ['tenant' => $tenant, 'record' => $site->id])] = 'Site';

        $breadcrumbs[route('filament.app.resources.ag-systems.edit', ['tenant' => $tenant, 'record' => $this->record->id])] = 'Edit Agricultural System';

        return $breadcrumbs;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record->id]);
    }

}
