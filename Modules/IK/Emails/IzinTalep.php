<?php

namespace Modules\IK\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\IK\Entities\Izin;

class IzinTalep extends Mailable
{
    use Queueable, SerializesModels;

    public $izin;
    public $Mesaj;
    public $Excel;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Izin $izin, $Mesaj, $Excel = null)
    {
        $this->izin = $izin;
        $this->Mesaj = $Mesaj;
        $this->Excel = $Excel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->Excel == null)
            return $this->view('ik::emails.izintalep');
        else
            return $this->view('ik::emails.izintalep')
                ->attach($this->Excel, [
                    "as" => "IzinTalepFormu.xlsx",
                    "mime" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                ]);
    }
}
