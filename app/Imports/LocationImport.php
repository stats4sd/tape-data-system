<?php

namespace App\Imports;

use App\Models\Import;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;

/**
 * NOTE - here we use the WithMultipleSheets interface, *even though* we are only interested in one worksheet. This is to make sure we only retrieve data from a single worksheet, no matter how many are in the file. (Otherwise the import would fail if the file had more than one worksheet with different formats of data on different sheets).
 */
class LocationImport implements ShouldQueue, WithBatchInserts, WithChunkReading, WithEvents, WithMultipleSheets
{
    public function __construct(public array $data)
    {
    }

    public function sheets(): array
    {
        return [
            0 => new LocationSheetImport($this->data),
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {


                Import::find($this->data['import_id'])
                    ->update([
                        'errors' => $event->getException()->getMessage(),
                    ]);
            },
            AfterImport::class => function (AfterImport $event) {
                Notification::make()
                    ->title('Import Complete')
                    ->success()
                    ->broadcast(User::find($this->data['user_id']));
            },
        ];
    }
}
