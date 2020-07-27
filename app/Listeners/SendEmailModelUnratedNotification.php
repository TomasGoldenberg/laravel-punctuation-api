<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ModelUnratedNotification;
use App\Product;

class SendEmailModelUnratedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle(ModelUnrated $event)
    {
        /** @var Product  */
//obtenemos el calificado
        $rateable = $event->getRateable();

        //si el calificado es un producto
        //creamos una notificacion
        // y le pasamos el nombre del calificador y el calificado
        if($rateable instanceof Product){
            $notification = new ModelUnratedNotification(
                $event->getQualifier()->name,
                $rateable
            );

            //product tiene la relacion con el user createdBY y le notificamos la notificacion
            $rateable->createdBy->notify($notification);
        }
    }
}
