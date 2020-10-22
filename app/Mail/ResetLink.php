<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetLink extends Mailable
{
    use Queueable, SerializesModels;
    private $account, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($account, $token)
    {
        $this->account = $account;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reset-link', [
            'token' => $this->token,
            'account' => $this->account
        ])
            ->subject('Password reset link');
    }
}
