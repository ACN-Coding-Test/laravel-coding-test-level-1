<?php

use App\Mail\NewEventMail;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

function callApi($method, $url, $data = false, $isJson = false, $token = false) {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if ($token) {
        $array[] = "Authorization: Bearer ".$token;
    }
    $array[] = 'Accept: application/json';
    if ($isJson) {
        $array[] = 'Content-Type: application/json';
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $array);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    $result = [
        'data' => $response,
        'http_status' => $httpcode
    ];

    return $result;
}

function sendNewEventMail(Event $event)
{
    $users = User::all();

    $maildata = [
        'name' => $event->name,
        'slug' => $event->slug,
    ];

    foreach ($users as $user) {
        Mail::to($user->email)->send(new NewEventMail($maildata));
    }

}
