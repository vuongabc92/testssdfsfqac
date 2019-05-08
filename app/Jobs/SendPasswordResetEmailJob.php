<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notifiable;

class SendPasswordResetEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Notifiable;

    protected $notifiable;

    public $email;

    /**
     * Create a new job instance.
     * @param $notifiable
     * @param $email
     *
     * @return void
     */
    public function __construct($notifiable, $email)
    {
        $this->notifiable = $notifiable;
        $this->email      = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->notify($this->notifiable);
    }
}
