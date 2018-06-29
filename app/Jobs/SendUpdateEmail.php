<?php

namespace App\Jobs;

use App\Mail\EmailUserUpdate;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendUpdateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $message;

    /**
     * Create a new job instance.
     *
     * SendVerificationEmail constructor.
     * @param $user
     */
    public function __construct($user, $message)
    {
        //
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new EmailUserUpdate($this->user, $this->message);
        Mail::to($this->user->email)->send($email);
    }
}
