<?php

namespace App\Imports;

use App\Filament\App\Resources\ImportResource;
use App\Models\Import;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\Validators\ValidationException;

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
            ImportFailed::class => function (ImportFailed $event) {

                // check if exception is a validation exception, and get the failures from it
                if ($event->getException() instanceof ValidationException) {
                    $failures = collect($event->getException()->failures());

                    ray($failures);
                    Import::find($this->data['import_id'])
                        ->update([
                            'errors' => $failures->map(function ($failure) {
                                return [
                                    'location' => [
                                        'row' => $failure->row(),
                                        'column' => $failure->attribute(),
                                    ],
                                    'errors' => $failure->errors(),
                                ];
                            })->toArray(),
                        ]);
                } else {
                    ray('OH NO! ANyway...');
                    Import::find($this->data['import_id'])
                        ->update([
                            'errors' => [
                                [
                                    'row' => null,
                                    'attribute' => null,
                                    'errors' => [$event->getException()->getMessage()],
                                ],
                            ],
                        ]);
                }
                Notification::make()
                    ->title('Import of Farm Data Failed')
                    ->body(fn (): HtmlString => new HtmlString(
                        'The import of farm data failed with the following errors:<br/><br/>'
                        . $event->getException()->getMessage()
                        . '<br/><br/>You can review this import in the <a href="' . ImportResource::getUrl('index', ['tenant' => $this->data['team_id']]) . '">Imports pages</a>.'
                    ))
                    ->danger()
                    ->broadcast(User::find($this->data['user_id']));
            },
            AfterImport::class => function (AfterImport $event) {
                Notification::make()
                    ->title('Import of Farm Data Complete')
                    ->success()
                    ->broadcast(User::find($this->data['user_id']));
            },
        ];
    }
}
