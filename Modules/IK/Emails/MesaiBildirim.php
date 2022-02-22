<?php

namespace Modules\IK\Emails;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MesaiBildirim extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $Tarih;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $Tarih)
    {
        $this->user = $user;
        $this->Tarih = $Tarih;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ik::emails.mesaibildirimi');
    }
}
