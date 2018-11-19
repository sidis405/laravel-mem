<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostWasUpdatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $recipient;
    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $recipient, $post)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $roleLabel = $this->sender->role;
        return $this->with(['roleLabel' => $roleLabel ])->subject('A post was updated on the MEM Blog')->markdown('emails.posts.updated-email');
    }
}
