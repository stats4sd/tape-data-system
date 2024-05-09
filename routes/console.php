<?php

use App\Console\Commands\PurgeTelescopeEntries;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(PurgeTelescopeEntries::class)->daily();
