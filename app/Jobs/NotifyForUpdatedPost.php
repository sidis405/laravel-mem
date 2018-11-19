<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\PostWasUpdatedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyForUpdatedPost implements ShouldQueue
{
    protected $recipient;
    protected $sender;
    protected $post;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient, $sender, $post)
    {
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->recipient)->send(new PostWasUpdatedEmail($this->sender, $this->recipient, $this->post));
    }
}
