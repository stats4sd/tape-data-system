<?php

namespace App\Console\Commands;

use App\Exports\ExcelExport;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Console\Command;
use App\Imports\ExcelSheetImport;

class AddNewColumnsForSelectMultiple extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-new-columns-for-select-multiple';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new columns in exported excel file for select_multiple columns';

    /**
     * Execute the console command.
     */
    public function handle()
    {


        // Steps:
        // 1. Read data extraction excel file into array
        // 2. Handle each excel sheet in array, scan for select_multiple column names in first row
        // 3. When select_multiple column name found, add new columns for all possible values
        // 4. For each data row, fill in 0 or 1 for newly added select_multiple columns
        // 5. When all excel sheets are processed, export the handled array to a new excel file

        $this->info('start');

        // ********** //
        // 1. Read data extraction excel file into array
        // ********** //

        $inputFilename = 'tape_data_export_5.xlsx';
        $outputFilename = 'tape_data_export_handled.xlsx';

        $this->comment('Reading excel file into memory, it will take a while...');
        $sheets = Excel::toCollection(new ExcelSheetImport, Storage::disk('data_extraction')->path($inputFilename));
        $this->comment('Reading excel file completed');

        // ********** //
        // 2. Handle each excel sheet in array, scan for select_multiple column names in first row
        // ********** //

        // handle Main_Survey sheet

        $index = 2;

        $mainSurveySheet = $sheets[$index]->map(function (Collection $row) {

            $options = [
                'prod_output' => [1, 2, 3, 4, 5, 77],
                'cropsnum' => [221, 711, 515, 526, 226, 366, 367, 572, 203, 486, 44, 558, 552, 216, 181, 89, 358, 101, 461, 426, 217, 591, 125, 378, 265, 393, 220, 191, 459, 693, 512, 698, 661, 249, 813, 554, 397, 550, 577, 754, 176, 689, 195, 403, 187, 399, 569, 773, 94, 619, 463, 542, 406, 720, 549, 507, 560, 414, 401, 656, 446, 402, 417, 242, 225, 777, 336, 677, 277, 780, 310, 592, 224, 407, 420, 497, 201, 372, 333, 210, 56, 571, 809, 671, 568, 299, 79, 103, 449, 292, 836, 702, 234, 75, 254, 430, 260, 490, 600, 534, 521, 687, 748, 587, 197, 574, 223, 489, 536, 296, 116, 211, 394, 523, 92, 788, 270, 547, 27, 71, 280, 328, 289, 263, 789, 83, 530, 236, 723, 373541, 544, 423, 157, 156, 267, 531, 122, 305, 495, 136, 667, 388, 97, 603, 275, 826, 692, 205, 222, 567, 15, 137, 135, 'teff'],
                'cfpnum' => [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 281, 282, 29, 30, 31, 32, 33, 34, 35],
                'animnum' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
                'anprodnum' => [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31],
                'essential_rev' => [1, 2, 3, 4, 5, 77],
                'mitig' => [1, 2, 3, 4, 5, 6, 77, 8],
                'ecoman' => [1, 2, 3, 4, 5, 77, 7],
            ];

            $this->info('handling farm_id ' . $row['farm_id']);

            foreach ($options as $key => $value) {
                $output = collect(str_getcsv($row[$key], separator: ' '));

                foreach ($value as $option) {
                    if ($output->contains($option)) {
                        $row["{$key}_{$option}"] = 1;
                    } else {
                        $row["{$key}_{$option}"] = 0;
                    }
                }
            }

            return $row;
        });


        $performancesChemicalPesticides = $sheets[9]->map(function (Collection $row) {
            $cpcropOptions = [221, 711, 515, 526, 226, 366, 367, 572, 203, 486, 44, 558, 552, 216, 181, 89, 358, 101, 461, 426, 217, 591, 125, 378, 265, 393, 220, 191, 459, 693, 512, 698, 661, 249, 813, 554, 397, 550, 577, 754, 176, 689, 195, 403, 187, 399, 569, 773, 94, 619, 463, 542, 406, 720, 549, 507, 560, 414, 401, 656, 446, 402, 417, 242, 225, 777, 336, 677, 277, 780, 310, 592, 224, 407, 420, 497, 201, 372, 333, 210, 56, 571, 809, 671, 568, 299, 79, 103, 449, 292, 836, 702, 234, 75, 254, 430, 260, 490, 600, 534, 521, 687, 748, 587, 197, 574, 223, 489, 536, 296, 116, 211, 394, 523, 92, 788, 270, 547, 27, 71, 280, 328, 289, 263, 789, 83, 530, 236, 723, 373, 541, 544, 423, 157, 156, 267, 531, 122, 305, 495, 136, 667, 388, 97, 603, 275, 826, 692, 205, 222, 567, 15, 137, 135, 'teff'];

            $this->info('handling farm_id ' . $row['farm_id']);

            $output = collect(str_getcsv($row['cpcrop'], separator: ' '));

            foreach ($cpcropOptions as $option) {
                if ($output->contains($option)) {
                    $row["cpcrop_{$option}"] = 1;
                } else {
                    $row["cpcrop_{$option}"] = 0;
                }
            }

            return $row;
        });

        $performancesYouthEmigrants = $sheets[11]->map(function(Collection $row) {

            $yEmigWhyOptions = [1, 2, 3, 4, 77];

            $this->info('handling farm_id ' . $row['farm_id']);

            $output = collect(str_getcsv($row['y_emig_why'], separator: ' '));

            foreach($yEmigWhyOptions as $option) {
                if($output->contains($option)) {
                    $row["y_emig_why_{$option}"] = 1;
                } else {
                    $row["y_emig_why_{$option}"] = 0;
                }
            }

            return $row;
        });

        $newSheets = collect([
            'Main_Survey' => $mainSurveySheet,
            'Performances_Chemical_Pesticides' => $performancesChemicalPesticides,
            'Performances_Youth_Emigrants' => $performancesYouthEmigrants,
        ]);

        Excel::store(new ExcelExport($newSheets), $outputFilename, disk: 'data_extraction');


        $this->info('done!');
    }


}
