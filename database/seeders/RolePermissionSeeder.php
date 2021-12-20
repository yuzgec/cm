<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate(false);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Super Vizör']);
        Role::create(['name' => 'Agent']);
        Role::create(['name' => 'İcra']);
    }
}
