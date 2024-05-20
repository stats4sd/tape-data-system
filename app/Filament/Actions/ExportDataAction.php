<?php

namespace App\Filament\Actions;

use App\Exports\MainSurveyExport;
use App\Http\Controllers\DataExportController;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function () {
            $filePath = $this->exportAllTape();
            return $this->download($filePath);
        });
    }

    public function exportAllTape(): string
    {
        $filePath = 'Tape GIZ-data-export' . '-' . now()->toDateTimeString() . '.xlsx';
        Excel::store(new MainSurveyExport(), $filePath);

        return $filePath;
    }

    public function download(string $filePath)
    {
        return Storage::download($filePath);
    }
}
