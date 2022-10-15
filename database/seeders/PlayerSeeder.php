<?php


namespace Database\Seeders;

use App\Models\Event;
use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $player1 = Player::create(
            [
                'chat_id' => '1413405776',
                'name' => 'Sebastian',
                'rating' => 8,
                'active' => 1,
            ]
        );

    }
}
