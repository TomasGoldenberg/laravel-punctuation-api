<?php

namespace App\Console\Commands;

use App\User;
use App\Product;

use App\Notifications\NewsletterNotification;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendNewsLetterCommand extends Command
{

    protected $signature = 'send:newsletter 
                                        {emails?*}
                                        {--s|shedule : si debe ser ejecutado directamente}'
                                        ;


    protected $description = 'Envia un Correo Electronicos';



    /** Execute the console command.*/
    public function handle()
    {
        $emails = $this->argument("emails");
        $builder= User::query();

        if($emails){ //que pase en email , los emails del param
            $builder->whereIn("email",$emails);
        }
        $builder->whereNotNull("email_verified_at");
        $count = $builder->count();

        

        if($count){
            $this->info("se enviaran {$count} correos");
            
            if($this->confirm("Estas de acuerdo?"|| $schedule)){
            
                $productQuery = Product::query();
                $productQuery->withCount(['qualifications as average_rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(score),0)'));
                }])->orderByDesc('average_rating');

                $products = $productQuery->take(6)->get();


                $this->output->ProgressStart($count);
            $builder
            ->whereNotNull("email_verified_at")
            ->each( function(User $user){
                $user->notify(new NewsletterNotification());
                $this->output->progressAdvance();
            } );

            }

        $this->info("Se enviaron {$count} correos");
        $this->output->progressFinish();
            return;
        }

        if(!$count){

            $this->info("No se envio ningun correo");
        };

        
        
    }
}
