<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PurgeTelescopeEntries extends Command
{
    protected $signature = 'app:purge-telescope-entries';

    protected $description = 'Command description';

    public function handle(): void
    {
        $this->info('Purging Telescope entries from more than 1 week ago...');

        Artisan::call('telescope:prune --hours=168');

        $this->info('Telescope entries purged!');
    }
}
