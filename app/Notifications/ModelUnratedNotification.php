<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ModelUnratedNotification extends Notification
{
    use Queueable;

 
    private $qualifierName;
    private $productName;
 //esto nos llega primero el qualifier y luuego el product porque en ese orden le pasamos los params a la new ModelUnratedNotification que es este archivo
    public function __construct(string $qualifierName, string $productName)
    {
        $this->qualifierName = $qualifierName;
        $this->productName = $productName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("{$this->qualifierName} a decidido eliminar su puntaje de tu producto :{$this->productName}");
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
