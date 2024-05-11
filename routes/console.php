<?php

use App\Console\Commands\PurgeTelescopeEntries;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Stats4sd\FilamentOdkLink\Commands\PollForOdkData;

Schedule::command(PurgeTelescopeEntries::class)->daily();
Schedule::command(PollForOdkData::class)->everyFiveMinutes();
