<?php

namespace App\Console\Commands;

use App\User;
use App\Notifications\NewsletterNotification;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendNewsLetterCommand extends Command
{

    protected $signature = 'send:newsletter {emails?*}';


    protected $description = 'Envia un Correo Electronicos';



    /** Execute the console command.*/
    public function handle()
    {
        $emails = $this->argument("emails");
        $builder= User::query();

        if($emails){ //que pase en email , los emails del param
            $builder->whereIn("email",$emails);
        }

        $count = $builder->count();

        

        if($count){
            $this->output->ProgressStart($count);


            $builder
            ->whereNotNull("email_verified_at")
            ->each( function(User $user){
                $user->notify(new NewsletterNotification());
                $this->output->progressAdvance();
            } );

        $this->info("Se enviaron {$count} correos");
        $this->output->progressFinish();

        }

        if(!$count){

            $this->info("No se envio ningun correo");
        };

        
        
    }
}
