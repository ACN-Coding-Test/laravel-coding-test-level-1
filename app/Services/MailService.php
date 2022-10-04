<?php

namespace App\Services;

use App\Mail\CreateEvent;
use Illuminate\Support\Facades\Mail;

class MailService
{
	public function sendEvents($event)
	{
        $mail = Mail::to('newuser@example.com')->send(new CreateEvent());
        if(!$mail) return false;
        return true;
	}
}