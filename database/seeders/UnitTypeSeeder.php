<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnitType::create([
            'name' => 'weight',
            'si_unit' => 'KG',
        ]);

        UnitType::create([
            'name' => 'area',
            'si_unit' => 'HA',
        ]);
    }
}
