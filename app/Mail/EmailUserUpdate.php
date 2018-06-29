<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserUpdate extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $message;

    /**
     * EmailUserUpdate constructor.
     * @param $user
     * @param $message
     */
    public function __construct($user, $message)
    {
        //
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.user_update')->with([
            'name'      => $this->user->name,
            'message'   => $this->message,
        ]);
    }
}
