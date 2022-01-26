<?php

namespace Modules\IK\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\IK\Emails\IzinTalep;
use Modules\IK\Entities\Izin;

class IzinTalepEMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $izin;
    protected $Adres;
    protected $Mesaj;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Izin $izin,$Adres, $Mesaj)
    {
        $this->izin = $izin;
        $this->Adres = $Adres;
        $this->Mesaj = $Mesaj;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $EMail = new IzinTalep($this->izin);
        Mail::to($this->Adres)->send(new IzinTalep($this->izin, $this->Mesaj));
    }
}
