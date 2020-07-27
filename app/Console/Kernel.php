<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\SendEmailVerificationReminderCommand;
use App\Console\Commands\SendNewsLetterCommand;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        
    SendEmailVerificationReminderCommand::class,
    SendNewsLetterCommand::class
    ];


    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
            ->evenInMaintenanceMode() 
            ->sendOutputTo(storage_path("inspire.log")) ///crea un archivo para ver logs °° es importante poner el arhivo de logs en gitIgnore
            ->everyMinute();

        //$schedule->call( function(){
        //    echo "hola";
        //})->everyFiveMinutes();

        $schedule->command(SendNewsLetterCommand::class)
            ->withoutOverlapping() //evita superposicion de tarea, evita que se ejecute si ya esta corriendo la instancia
            ->onOneServer()
            ->mondays();

        $schedule->command(SendEmailVerificationReminderCommand::class)
            ->onOneServer() //si tu app esta en mas de 1 server ponemos esto para que solo dispare emails 1 vez
            ->daily();


    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
