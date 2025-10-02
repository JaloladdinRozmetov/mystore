<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class ContactCreatedTelegram extends Notification
{
    use Queueable;

    public function __construct(public Contact $contact) {}

    public function via($notifiable): array
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        $c = $this->contact;
        $lines = [
            "*New Contact*",
            "*Name:* {$c->name}",
            "*Phone:* {$c->phone}",
            "*User ID:* " . ($c->user_id ?? '—'),
        ];

        if ($c->description) {
            $lines[] = "*Message:* " . str($c->description)->limit(500);
        }

        return TelegramMessage::create()
            ->to(config('services.telegram.chat_id'))
            ->content(implode("\n", $lines))
            ->button('Open Admin', url('/admin/contacts/' . $c->id));
    }
}
