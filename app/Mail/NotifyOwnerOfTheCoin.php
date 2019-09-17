<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyOwnerOfTheCoin extends Mailable
{
    use Queueable, SerializesModels;

    public $story;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($story)
    {
        $this->story = $story;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Connectioncoin')->markdown('mail.notify-owner-of-the-coin');
    }
}
