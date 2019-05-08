<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification {

    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * User that has forgot password
     *
     * @var \App\Models\User $user
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param $token
     * @param $user
     *
     * @return void
     */
    public function __construct($token, $user) {
       $this->token = $token;
       $this->user  = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via() {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail() {
        return (new MailMessage)
            ->view('frontend.email.reset-password', [
                'user'     => $this->user,
                'resetUrl' => route('front_resetpass', [
                    'token' => $this->token,
                    'email' => $this->user->email
                ])
            ]);
    }

}
