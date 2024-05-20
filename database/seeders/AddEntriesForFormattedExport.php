<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddEntriesForFormattedExport extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(DataDictionaryEntriesTableSeeder::class);
        $this->call(XlsformChoiceListsTableSeeder::class);
        $this->call(XlsformChoicesTableSeeder::class);
    }
}
