<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user_otp;
    public function __construct($user_otp)
    {
        $this->user_otp = $user_otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['user_otp'] = $this->user_otp;

        return $this->view('mail.register', $data);
    }
}
