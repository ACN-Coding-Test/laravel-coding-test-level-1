<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
       $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];

        $url = env('API_URL') . "/register";
        $response = callApi('POST', $url, $data, false);

        if ($response['http_status'] != '401') {
            $data = json_decode($response['data'],true);
            Cookie::queue('session_id', $data['token']);
            return redirect('/events');
        } else {
            return redirect('/register')->withErrors(['message'=>'Registration Failed']);
        }
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $url = env('API_URL') . "/login";
        $response = callApi('POST', $url, $data, false);

        if ($response['http_status'] != '401') {
            $data = json_decode($response['data'],true);
            Cookie::queue('session_id', $data['token']);
            return redirect('/events');
        } else {
            return redirect('/login')->withErrors(['message'=>'Invalid Credentials']);
        }
    }

    public function logout() {
        Cookie::queue(Cookie::forget('session_id'));
        return redirect('/');
    }
}
