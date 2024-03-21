<?php

namespace App\Imports;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterImport;

/**
 * NOTE - here we use the WithMultipleSheets interface, *even though* we are only interested in one worksheet. This is to make sure we only retrieve data from a single worksheet, no matter how many are in the file. (Otherwise the import would fail if the file had more than one worksheet with different formats of data on different sheets).
 */
class FarmImport implements ShouldQueue, WithBatchInserts, WithChunkReading, WithEvents, WithMultipleSheets
{
    public function __construct(public array $data)
    {
    }

    public function sheets(): array
    {
        return [
            0 => new FarmSheetImport($this->data),
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
            AfterImport::class => function (AfterImport $event) {
                Notification::make()
                    ->title('Import of Farm Data Complete')
                    ->success()
                    ->broadcast(User::find($this->data['user_id']));
            },
        ];
    }
}
