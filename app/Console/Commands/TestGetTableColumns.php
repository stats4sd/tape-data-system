<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class TestGetTableColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-get-table-columns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all column names of a table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // check whether this xlsform template section has a related database table
        $class = '\App\Models\SurveyData\SimpleFormMain';

        if (!$class) {
            $this->info('This xlsform section is not related to any database table');
        } else {
            $reflection = new \ReflectionClass($class);
            $model = new $class;

            $this->info('This xlsform section is related to database table "' . $model->getTable() . '"');
            $this->comment($reflection->getName());
            $this->comment($model->getTable());

            // check database table existence
            if (!Schema::hasTable($model->getTable())) {
                $this->info('Database table "' . $model->getTable() . '" does not exist');
            } else {
                $this->info('Database table "' . $model->getTable() . '" exists');

                // get all column names of a table
                $columns = Schema::getColumnListing($model->getTable());

                $this->info('Column names:');
                foreach ($columns as $column) {
                    $this->comment($column);
                }

                // create a new database record
                $class::create(['qu' => 'test']);
            }
        }
    }
}
