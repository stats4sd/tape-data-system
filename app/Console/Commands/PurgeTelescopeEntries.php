<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class PurgeTelescopeEntries extends Command
{
    protected $signature = 'app:purge-telescope-entries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes telescope entries older than 1 week and optimises the tables to reclaim disk space.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // prune anything older than 1 week;
        Artisan::call('telescope:prune --hours 168');

        // optimise the tables to reclaim disk space (usually not needed; included here because the first time this is run there might be actual GBs of data to clean up / reclaim);
        DB::statement('OPTIMIZE TABLE telescope_entries');
        DB::statement('OPTIMIZE TABLE telescope_entries_tags');
        DB::statement('OPTIMIZE TABLE telescope_monitoring');
    }
}
