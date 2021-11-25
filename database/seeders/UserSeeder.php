<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
       $data =
           [
               [
                   'name' => 'Admin Hesabnı',
                   'email' => 'admin@admin.com',
                   'email_verified_at' => now(),
                   'telefon' => '5332802852',
                   'password' => Hash::make('admin'), // password
                   'remember_token' => Str::random(10),
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now()
               ]
         ];
        DB::table('users')->insert($data);
    }
}
