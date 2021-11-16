<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{

    public function run()
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Super Vizör']);
        Role::create(['name' => 'Agent']);
    }
}
