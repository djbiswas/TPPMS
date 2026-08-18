<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TenantActivationNotification extends Notification
{
    use Queueable;

    public function __construct(public string $token) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Activate your L&L tenant portal account')
            ->greeting('Welcome, '.$notifiable->name)
            ->line('Property management invited you to the L&L International Ventures tenant portal.')
            ->action('Activate my account', url(route('activation.show', $this->token, false)))
            ->line('If you did not expect this email, you can ignore it.');
    }
}
