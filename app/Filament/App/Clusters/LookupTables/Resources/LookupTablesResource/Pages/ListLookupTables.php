<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\LookupTablesResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\LookupTablesResource;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ListRecords;

class ListLookupTables extends ListRecords
{
    protected static string $resource = LookupTablesResource::class;

    protected static string $view = 'filament.pages.list-records';

    protected Infolist $tableInfoList;

    public function tableInfoList(Infolist $infolist): Infolist
    {
        return static::getResource()::tableInfolist($infolist);
    }
    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
