<?php

namespace App\Filament\App\Resources\XlsformResource\Pages;

use App\Filament\App\Resources\XlsformResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class ViewXlsform extends ViewRecord
{
    protected static string $resource = XlsformResource::class;

    public function getHeading(): string|Htmlable
    {
        return 'Submissions for form: ' . $this->record->title;
    }


}
