<?php

namespace Database\Seeders;

use App\Models\IzinTuru;
use Illuminate\Database\Seeder;

class IzinTurleriTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["id" => 1, "name" => "Yıllık İzin"],
            ["id" => 2, "name" =>  "Askerlik İzni"],
            ["id" => 3, "name" =>  "Babalık İzni"],
            ["id" => 4, "name" =>  "Doğum İzni"],
            ["id" => 5, "name" =>  "Doğum Sonrası İzni"],
            ["id" => 6, "name" =>  "Evlilik İzni"],
            ["id" => 7, "name" =>  "Hastalık İzni"],
            ["id" => 8, "name" =>  "İş Arama İzni"],
            ["id" => 9, "name" =>  "Mazeret İzni"],
            ["id" => 10, "name" =>  "Süt izni"],
            ["id" => 11, "name" =>  "Ücretsiz İzin"],
            ["id" => 12, "name" =>  "Vefat İzni"],
            ["id" => 13, "name" =>  "Yol İzni"],
        ];
        IzinTuru::query()->insert($data);
    }
}
