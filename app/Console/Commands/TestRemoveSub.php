<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Entity;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;
use Stats4sd\FilamentOdkLink\Models\OdkLink\EntityValue;

class TestRemoveSub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:trs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all records from table entity_values, entities, submissions; Flush cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();

        EntityValue::destroy(EntityValue::all()->pluck('id')->toArray());
        Entity::destroy(Entity::all()->pluck('id')->toArray());
        Submission::destroy(Submission::all()->pluck('id')->toArray());

        // submission table uses soft delete, which is not working because column odk_id is unique.
        // we need to remove all physical records before retrieve submissions from ODK central
        Submission::truncate();

        Cache::flush();
    }
}
