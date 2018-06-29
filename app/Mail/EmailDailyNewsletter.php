<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailDailyNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $wod;

    /**
     * EmailDailyNewsletter constructor.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.newsletter.daily')->with([
            'name'  => $this->user->name,
            'wod'   => $this->wod,
        ]);
    }
}
