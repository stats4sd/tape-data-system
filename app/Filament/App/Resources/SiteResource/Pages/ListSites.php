<?php

namespace App\Filament\App\Resources\SiteResource\Pages;

use App\Filament\App\Resources\LocationLevelResource;
use App\Filament\App\Resources\SiteResource;
use App\Models\SampleFrame\LocationLevel;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSites extends ListRecords
{
    protected static string $resource = SiteResource::class;

    protected ?string $heading = 'TAPE Survey Sites';

    protected ?string $subheading = 'A list of all geographic survey sites for this project';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('link_to_locations')
                ->label('Add Site(s)')
                ->url(LocationLevelResource::getUrl('view', ['record' => LocationLevel::where('parent_id', null)->first()])),
        ];
    }
}
