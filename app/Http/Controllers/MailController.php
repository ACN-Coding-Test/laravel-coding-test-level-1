<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Services\MailService;

class MailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sendEvents()
    {
        $ms = new MailService();
        $mail = $ms->sendEvents([]);
        
        if(!$mail) return Redirect::back()->withErrorMessage("Failed! email not send");
        return Redirect::back()->withSuccessMessage("Successfully send email");
    }
}
