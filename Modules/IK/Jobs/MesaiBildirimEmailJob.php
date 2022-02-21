<?php

namespace Modules\IK\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\IK\Emails\MesaiBildirim;

class MesaiBildirimEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $Email;
    protected $User;
    protected $Tarih;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Email, User $User, $Tarih)
    {
        $this->Email = $Email;
        $this->User = $User;
        $this->Tarih = $Tarih;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->Email)
            ->send(new MesaiBildirim($this->User, $this->Tarih));
    }
}
