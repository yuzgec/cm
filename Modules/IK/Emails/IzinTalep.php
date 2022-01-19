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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Izin $izin)
    {
        $this->izin = $izin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ik::emails.izintalep');
    }
}
