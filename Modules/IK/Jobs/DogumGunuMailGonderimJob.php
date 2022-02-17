<?php

namespace Modules\IK\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\IK\Emails\DogunuMail;

class DogumGunuMailGonderimJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $User;
    protected $Adres;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $Adres)
    {
        $this->User = $user;
        $this->Adres = $Adres;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->Adres)
            ->send(new DogunuMail($this->User));
    }
}
