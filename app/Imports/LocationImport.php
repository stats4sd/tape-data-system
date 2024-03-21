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
            AfterImport::class => function (AfterImport $event) {
                Notification::make()
                    ->title('Import Complete')
                    ->success()
                    ->broadcast(User::find($this->data['user_id']));
            },
        ];
    }
}
