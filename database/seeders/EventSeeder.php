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
                'owner_chat_id' => '-870090894',
                'creator_chat_id' => '1413405776',
                'active' => 1,
                'isNewly' => 0,
            ]
        );



    }
}
