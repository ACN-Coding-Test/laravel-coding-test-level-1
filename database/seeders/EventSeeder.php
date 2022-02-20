<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //testing dummy data using factory
        // Event::factory()->count(5)->create();

        $events = ['swimming', 'running', 'jogging', 'hiking', 'walking'];

        foreach ($events as $event => $data) {

            $slug = Str::slug($data, '-');
            $start_at = Carbon::now();
            $end_at = Carbon::now()->addDays(2);

            $data_event['name'] = $data;
            $data_event['slug'] = $slug;
            $data_event['start_at'] =  $start_at;
            $data_event['end_at'] = $end_at;

            $create_user = Event::create($data_event);
        }
    }
}
