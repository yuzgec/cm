<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permissions = [
            [
                "name" => "Agent Yönetimi",
                "parent_id" => 0,
                "subs" => [
                    ["name" => "Agent Ekle", "parent_id" => 0],
                    ["name" => "Agent Düzenle", "parent_id" => 0],
                    ["name" => "Agent Sil", "parent_id" => 0],
                ]
            ],
            [
                "name" => "Rapor Yönetimi",
                "parent_id" => 0,
                "subs" => [
                    ["name" => "Personel Raporlama", "parent_id" => 0],
                    ["name" => "Çağrı Raporlama", "parent_id" => 0],
                    ["name" => "Ödeme Raporlama", "parent_id" => 0],
                ]
            ],
            [
                "name" => "Ayar Yönetimi",
                "parent_id" => 0,
                "subs" => []
            ],
            [
                "name" => "CallCenter",
                "parent_id" => 0,
                "subs" => []
            ],
            [
                "name" => "Dosya Yönetimi",
                "parent_id" => 0,
                "subs" => [
                    ["name" => "Dosya Ekle", "parent_id" => 0],
                    ["name" => "Dosya Düzenle", "parent_id" => 0],
                    ["name" => "Dosya Sil", "parent_id" => 0],
                ]
            ],
            [
                "name" => "Kullanıcı Yönetimi",
                "parent_id" => 0,
                "subs" => [
                    ["name" => "Kullanıcı Ekle", "parent_id" => 0],
                    ["name" => "Kullanıcı Düzenle", "parent_id" => 0],
                    ["name" => "Kullanıcı Sil", "parent_id" => 0],
                    ["name" => "Kullanıcı Rol Yönetimi", "parent_id" => 0],
                ]
            ],
            [
                "name" => "Ödeme Al",
                "parent_id" => 0,
                "subs" => []
            ],
            [
                "name" => "SMS",
                "parent_id" => 0,
                "subs" => [
                    ["name" => "SMS Gönderme", "parent_id" => 0],
                    ["name" => "SMS Raporlama", "parent_id" => 0],
                ]
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($Permissions as $Row){
            $Permission = new Permission();
            $Permission->name = $Row["name"];
            $Permission->guard_name = "web";
            $Permission->parent_id = $Row["parent_id"];
            $Permission->save();
            if(count($Row["subs"]) > 0){
                foreach($Row["subs"] as $R){
                    $Rol = new Permission();
                    $Rol->name = $R["name"];
                    $Rol->guard_name = "web";
                    $Rol->parent_id = $Permission->id;
                    $Rol->save();
                }
            }
        }
    }
}
