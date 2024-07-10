<?php

namespace App\Console\Commands;

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


        // define select_multiple column name for each excel sheet
        $selectMultipleColumnNames = [
            [''],
            [],
            ['prod_output', 'cropsnum', 'animnum', 'anprodnum'],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
        ];

        // assume all ODK variables are unique in all excel sheets
        $selectMultipleColumnValues = array(
            'prod_output' => '1,2,3,4,5,6',
            'cropsnum' => '515,572,14,15',
            'animnum' => '1,2,3,4,5',
            'anprodnum' => '1,2,3,4,5,6',
        );

        $this->info('start');

        // ********** //
        // 1. Read data extraction excel file into array
        // ********** //

        // out of memory issue occurred when running on Dan's computer, may need to read and handle each excel sheet individually
        // error:
        // PHP Fatal error:  Allowed memory size of 2147483648 bytes exhausted (tried to allocate 4096 bytes) in C:\public\tape-data-system\vendor\laravel\framework\src\Illuminate\Container\Container.php on line 979
        // PHP Fatal error:  Allowed memory size of 2147483648 bytes exhausted (tried to allocate 32768 bytes) in C:\public\tape-data-system\vendor\sentry\sentry\src\EventHint.php on line 1

        // $inputFilename = 'storage/data_extraction/tape_data_export.xlsx';
        $inputFilename = 'storage/data_extraction/test.xlsx';
        $outputFilename = 'storage/data_extraction/tape_data_export_handled.xlsx';

        $this->comment('Reading excel file into memory, it will take a while...');
        $sheets = Excel::toArray(new ExcelSheetImport, $inputFilename);
        $this->comment('Reading excel file completed');


        // ********** //
        // 2. Handle each excel sheet in array, scan for select_multiple column names in first row
        // ********** //

        // handle Main_Survey sheet


        $index = 2;

        $columnNames = $selectMultipleColumnNames[$index];
        $sheet = $sheets[$index];
        $headers = $sheet[0];

        $newSheet = [];
        $newHeaders = [];
        $selectMultipleColumnIndexes = [];

        // handle column headers
        for ($i = 0; $i < count($headers); $i++) {
            array_push($newHeaders, $headers[$i]);

            // add new column for select_multiple
            if (in_array($headers[$i], $columnNames)) {
                array_push($selectMultipleColumnIndexes, $i);
                $values = $selectMultipleColumnValues[$headers[$i]];
                $options = str_getcsv($values);

                foreach ($options as $option) {
                    array_push($newHeaders, $headers[$i] . '_' . $option);
                }
            }
        }

        array_push($newSheet, $newHeaders);


        // ********** //
        // 3. When select_multiple column name found, add new columns for all possible values
        // 4. For each data row, fill in 0 or 1 for newly added select_multiple columns
        // ********** //

        // handle data rows
        // for ($i = 1; $i < count($sheet); $i++) {

        // try one row for testing
        for ($i = 1; $i < 2; $i++) {
            $row = $sheet[$i];
            $newRow = [];

            // handle each cell
            for ($j = 0; $j < count($row); $j++) {
                dump($row[$j]);
                array_push($newRow, $row[$j]);

                if (in_array($j, $selectMultipleColumnIndexes)) {
                    dump('handling required here');

                    // get select_multiple column name
                    $columnName = $headers[$j];
                    dump($columnName);

                    // get select_multiple options
                    $values = $selectMultipleColumnValues[$columnName];
                    $options = str_getcsv($values);
                    dump($options);

                    $userSelectedValues = str_getcsv($row[$j], ' ');
                    dump($userSelectedValues);

                    // determine 0 or 1 for each option
                    foreach ($options as $option) {
                        if (in_array($option, $userSelectedValues)) {
                            array_push($newRow, 1);
                        } else {
                            array_push($newRow, 0);
                        }
                    }
                }
            }

            dump($newRow);
            array_push($newSheet, $newRow);
        }

        dump('======');
        dump($selectMultipleColumnIndexes);
        dump($sheet);
        dump($newSheet);
        dump('======');


        // ********** //
        // 5. When all excel sheets are processed, export the handled array to a new excel file
        // ********** //


        // TODO: export $newSheets to a new excel file


        $this->info('done!');
    }
}
