<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sympiesMailer;

class mailer extends Controller
{
    public function sendEmailReminder()
    {

        Mail::to("kataga.pupqc@gmail.com")->send(new sympiesMailer);
    }
}
