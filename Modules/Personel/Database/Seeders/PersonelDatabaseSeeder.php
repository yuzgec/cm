<?php

namespace Modules\Personel\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Personel\Entities\Mesai;

class PersonelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
       //$this->call("MesaiSeederTableSeeder");

        Mesai::create(['mesai_adi' => 'Hukuk']);
        Mesai::create(['mesai_adi' => 'İdari İşler']);
        Mesai::create(['mesai_adi' => 'İcra']);
        Mesai::create(['mesai_adi' => 'Değer Kaybı']);
        Mesai::create(['mesai_adi' => 'Dış Görev']);
    }
}
