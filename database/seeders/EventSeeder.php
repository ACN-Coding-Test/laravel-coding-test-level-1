<?php

namespace Database\Seeders;

use App\Models\Event;
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
        $events = [
            [
                'name' => "Event1",
                'startAt' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days')),
                'endAt' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days'))
            ],
            [
                'name' => "Event2",
                'startAt' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days')),
                'endAt' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days'))
            ],
            [
                'name' => "Event3",
                'startAt' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days')),
                'endAt' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days'))
            ],
            [
                'name' => "Event4",
                'startAt' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days')),
                'endAt' => date('Y-m-d', strtotime( '+'.mt_rand(0,5).' days'))
            ],
            [
                'name' => "Event5",
                'startAt' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days')),
                'endAt' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days'))
            ],
            [
                'name' => "Event6",
                'startAt' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days')),
                'endAt' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days'))
            ],
        ];
        foreach ($events as $event) {
            Event::create($event);
        }
       
    }
}
