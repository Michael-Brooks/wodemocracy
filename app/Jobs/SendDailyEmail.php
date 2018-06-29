<?php

namespace App\Jobs;

use App\Mail\EmailDailyNewsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendDailyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $wod;

    /**
     * SendDailyEmail constructor.
     * @param $user
     * @param $wod
     */
    public function __construct($user, $wod)
    {
        //
        $this->user = $user;
        $this->wod = $wod;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new EmailDailyNewsletter($this->user, $this->wod);
        Mail::to($this->user->email)->send($email);
    }
}
