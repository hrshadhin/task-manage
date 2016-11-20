<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeToTaskManage extends Mailable
{
    use Queueable, SerializesModels;

    public $greeting;
    public $level="success";
    public $introLines =[
    "Welcome to Task Manage! You're almost ready to use it.",
    "Here you can mange your task. like create,Manage,Archive and clear."
    ];
    public $actionText="Get Start";
    public $actionUrl;
    public $outroLines = [
    "Any problems, let us know at support@hrshadhin.me"
    ];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->greeting = "Hi, {$name} !";
        $this->actionUrl = url('/')."/login";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.welcome');
    }
}
