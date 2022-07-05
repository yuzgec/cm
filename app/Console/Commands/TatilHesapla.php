<?php

namespace App\Console\Commands;

use App\Helpers\IzinHesap;
use App\Helpers\TatilHesap;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Cmixin\BusinessTime;
use Illuminate\Console\Command;

class TatilHesapla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tatil:hesapla {user_id} {baslangic} {bitis} {tur}';

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
        $user_id = $this->argument('user_id');
        $baslangic = $this->argument('baslangic');
        $bitis = $this->argument('bitis');
        $tur = $this->argument('tur');
        $Fark = IzinHesap::IzinHesapla($user_id, $baslangic, $bitis, $tur);

        dd($Fark);

    }

}
