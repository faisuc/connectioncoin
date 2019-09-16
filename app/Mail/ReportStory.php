<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportStory extends Mailable
{
    use Queueable, SerializesModels;

    public $story;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($story, $message)
    {
        $this->story = $story;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Story has been reported!')->markdown('mail/report-story');
    }
}
