<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\PostWasDeletedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyForDeletedPost implements ShouldQueue
{
    public $recipient;
    public $sender;
    public $title;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient, $sender, $title)
    {
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->recipient)->send(new PostWasDeletedEmail($this->sender, $this->recipient, $this->title));
    }
}
