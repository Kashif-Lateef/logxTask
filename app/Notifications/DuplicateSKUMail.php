<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DuplicateSKUMail extends Notification
{
    public $sku;

    public function __construct($sku)
    {
        $this->sku = $sku;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A product with the same SKU already exists.')
            ->line('SKU: ' . $this->sku)
            ->action('View Product', url('/products/' . $this->sku))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
