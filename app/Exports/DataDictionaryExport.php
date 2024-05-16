<?php

namespace App\Exports;

use App\Models\DataDictionaryEntry;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataDictionaryExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths, WithStrictNullComparison
{
    public array $map;
    public Collection $dictionaryEntries;


    public function __construct()
    {
        $this->map = [
            'worksheet',
            'survey_section',
            'variable',
            'label_question',
            'type',
            'code_list',
        ];

        // we need these for the main dataset *and* for the styles, so we'll just grab them once.
        $this->dictionaryEntries = DataDictionaryEntry::all();
    }

    public function collection(): \Illuminate\Support\Collection
    {
        return $this->dictionaryEntries->map(
            // only take the columns we want
            fn (DataDictionaryEntry $entry) => $entry->only($this->map)
        );
    }

    public function headings(): array
    {
        return $this->map;
    }

    public function title(): string
    {
        return 'Data Dictionary';
    }

    public function styles(Worksheet $sheet): void
    {
        $wrap = [
            'alignment' => [
                'wrapText' => true
            ]
        ];

        $headingStyle = [
            'font' => [
                'bold' => true,
                'size' => 14
            ]
        ];

        $subHeadingStyle = [
            'font' => [
                'bold' => true,
            ],
        ];

        $endStyle = [
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ]
        ];


        // style the header
        $sheet->getStyle('1:1')->applyFromArray($headingStyle);

        // wrap the main question / label column
        $sheet->getStyle('D:D')->applyFromArray($wrap);


        // handle individual entries
        foreach ($this->dictionaryEntries as $index => $entry) {
            if ($entry->sub_heading) {
                $sheet->getStyle(2 + $index . ':' . 2 + $index)->applyFromArray($subHeadingStyle);
            }

            if ($entry->end_of_section) {
                $sheet->getStyle(2 + $index . ':' . 2 + $index)->applyFromArray($endStyle);
            }
        }

    }

    public function columnWidths(): array
    {
        return [
            'A' => 14,
            'B' => 16,
            'C' => 23,
            'D' => 50,
            'E' => 14,
            'F' => 14,
        ];
    }
}
