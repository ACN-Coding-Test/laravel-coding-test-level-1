<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = "http://127.0.0.1:8080/api/v1/events";
        $client = new Client();
        $response = $client->request('GET', $url);
        $events = json_decode($response->getBody()->getContents());
        // dd($events);

        return view('index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd("masuk");
        $url = "http://127.0.0.1:8080/api/v1/events/";
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => [
                'name' => $request->name,
                'startAt' => $request->startAt,
                'endAt' => $request->endAt,
            ]
        ]);

        return redirect()->route('events.store')->with('message', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = "http://127.0.0.1:8080/api/v1/events/".$id;
        $client = new Client();
        $response = $client->request('GET', $url);
        $event = json_decode($response->getBody()->getContents());

        return view('show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $url = "http://127.0.0.1:8080/api/v1/events/".$id;
        $client = new Client();
        $response = $client->get($url, [
            'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
            ],
        ]);

        $event = json_decode($response->getBody()->getContents());

        return view('edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $url = "http://127.0.0.1:8080/api/v1/events/".$id;
        $client = new Client();
        $response = $client->request('PUT', $url, [
            'json' => [
                'name' => $request->name,
                'startAt' => $request->startAt,
                'endAt' => $request->endAt,
            ]
        ]);

        return redirect()->route('events.store')->with('message', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url = "http://127.0.0.1:8080/api/v1/events/".$id;
        $client = new Client();
        $response = $client->delete($url);

        return redirect()->route('events.store')->with('message', 'Deleted successfully!');
    }
}
