<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostWasDeletedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $recipient;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $recipient, $title)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $roleLabel = $this->sender->role;
        return $this->subject('Your post was deleted on the MEM Blog')->markdown('emails.posts.deleted-email');
    }
}
