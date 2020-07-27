<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ModelRatedNotification extends Notification
{
    use Queueable;

    private $qualifierName;
    private $productName;
    private $score;


    public function __construct(string $qualifierName, string $productName, float $score)
    {
        $this->qualifierName    = $qualifierName;
        $this->productName      = $productName;
        $this->score            = $score;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("{$this->qualifierName} ha calificado tu producto: {$this->productName} con {$this->score} estrellas");
                   // ->action('Notification Action', url('/dashboardPuntaje'))
                   // ->line('gracias por confiar en mercado inpago!');
    }


}
