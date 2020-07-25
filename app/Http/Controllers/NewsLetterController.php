<?php

namespace App\Http\Controllers;

use App\Console\Commands\SendEmailVerificationReminderCommand;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SendNewsLetterCommand;

use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function sendNews(){
        Artisan::call(SendNewsLetterCommand::class);

        return response()->json([
            "data" => "Todo ok"
        ]);
    }


    public function sendReminder(){
        Artisan::call(SendEmailVerificationReminderCommand::class);

        return response()->json([
            "data" => "Reminder Enviado"
        ]);
    }
}


