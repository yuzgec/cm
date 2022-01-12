<?php

namespace App\Console\Commands;

use App\Models\RemoteMonitoring;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\PersonelBilgileri;

class PersonelAktar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'personelaktar';

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
        $Monitoring = RemoteMonitoring::query()->latest()->limit(10)->get();
        dd('Dur');
        $Personeller = Personel::all();
        $Prefix = [530,531,532,533,534,535,541,542,543,544,545,546,547,548,549];
        foreach ($Personeller as $Row){
            $Numara = $Prefix[rand(0,14)].rand(1000000,9999999);
            $Parcala = $this->AdSoyad($Row->adsoyad);
            $User = new User();
            $User->name = $Parcala["Name"];
            $User->last_name = $Parcala["LastName"];
            $User->email = $Row->email;
            $User->password = Hash::make($Row->email);
            $User->telefon = ($Row->telefon != 0) ? (int)$Row->telefon : (int)$Numara;
            $User->durum = 1;
            $User->tckn = $Row->tckn;
            $User->remote_id = $Row->remote_id;
            $User->save();

            $Pb = new PersonelBilgileri();
            $Pb->user_id = $User->id;
            $Pb->save();
        }
    }
    public function AdSoyad($Str){
        $Parcala = explode(" ", $Str);
        $LastName = array_pop($Parcala);
        $Name = implode(" ", $Parcala);

        return ["Name" => $Name, "LastName" => $LastName];
    }
}
