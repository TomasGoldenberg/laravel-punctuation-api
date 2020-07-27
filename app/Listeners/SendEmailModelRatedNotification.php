<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ModelRated;
use App\Notifications\ModelRatedNotification;
use App\Product;

class SendEmailModelRatedNotification
{

    public function __construct() //pasaremos por inyecion de dependencia cualquier servicio
    {
        //
    }


    public function handle(ModelRated $event) //logica de negocio que se ejecuta cuando se dispara el evento 
    {
        /** @var Product $rateable */
        $rateable = $event->getRateble();
        
        if( $rateable instanceof Product){ //si el calificado es un producto
            //crearemos esta notificacion
            $notification = new ModelRatedNotification(
                $event->getQualifier()->name,
                $rateable->name,
                $event->getScore()
            ); 

            //el product tiene la realacion createdBy y le notificaremos al user la notificacion que creamos
            $rateable->createdBy->notify($notification);
        }

    }
}
