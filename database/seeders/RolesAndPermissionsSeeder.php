<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);

        $adminPermissions = [
            ['name' => 'access admin panel'],
            ['name' => 'view all teams'],
        ];

        $admin->permissions()->createMany($adminPermissions);

    }
}
