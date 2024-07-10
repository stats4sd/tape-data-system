<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExcelSheetExport implements FromCollection, WithHeadings, WithTitle, WithStrictNullComparison
{
    public function __construct(public Collection $collection, public string $title)
    {
    }

    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return $this->collection[0]->keys()->toArray();
    }

    public function title(): string
    {
        return $this->title;
    }
}
