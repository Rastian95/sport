<?php

namespace Database\Seeders;

use App\Models\EventDetail;
use Illuminate\Database\Seeder;

class EventDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $event_detail1 = EventDetail::create(
            [
                'event_id' => 1,
                'player_id' => 1,
                'name' => 'Sebastian',
                'rating' => 8,
                'active' => 1,
            ]
        );

    }
}
