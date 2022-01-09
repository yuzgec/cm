<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
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
        $Personeller = Personel::all();
        foreach ($Personeller as $p){
            $user = new User;
            $user->mesai_id = $p->mesai_id;
            $user->remote_id =  $p->remote_id;
            $user->tckn =  $p->tckn;
            $user->name = $p->adsoyad;
            $user->telefon = rand(10000,9999999);
            $user->email = $p->email;
            $user->password = '$2y$10$3gqwMkpWg2KLCtXbu45mDOFPHotKHVuODF5Dexu1HJ2GnUy51rxkm';
            $user->durum = 1;
            $user->save();

            $Pb = new PersonelBilgileri;
            $Pb->user_id =  $user->id;
            $Pb->save();
        }

        $Pb = new PersonelBilgileri;
        $Pb->user_id =  1;
        $Pb->save();

    }
}
