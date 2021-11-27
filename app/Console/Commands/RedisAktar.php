<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Modules\Personel\Entities\Personel;

class RedisAktar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aktar:redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $Personel = Personel::findOrFail(1);
        $Redis = Redis::connection();
        $Tarihler = CarbonPeriod::create("2021-01-01", "2021-11-26");
        foreach ($Tarihler as $Tarih){
            dd($Tarih->format('d.m.Y'));
        }
        $Redis->hmset('persone:girisler:'.$Personel->id, [
            date('dmY') => 1
        ]);
        $Redis->hmset('persone:girisler:'.$Personel->id, [
            "25112021" => 1
        ]);
        dd($Personel->remote_id);
    }
}
