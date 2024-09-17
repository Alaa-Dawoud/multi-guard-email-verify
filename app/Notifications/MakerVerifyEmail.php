<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;

class MakerVerifyEmail extends VerifyEmailNotification
{
    use Queueable;

    public function __construct()
    {
        //
    }


    protected function verificationUrl($notifiable)
    {
        if ($notifiable === null) {
            throw new \Exception('Notifiable instance is null.');
        }
        return URL::temporarySignedRoute('guard_name.verification.verify', now()->addMinutes(60), [
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);
    }
}