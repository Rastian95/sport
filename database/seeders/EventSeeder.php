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

        $event1 = Event::create(
            [
                'title' => 'Jueves 8PM',
                'telegraph_chat_id' => 1,
                'active' => 1,
                'isNewly' => 0,
            ]
        );



    }
}
