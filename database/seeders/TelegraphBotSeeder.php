<?php


namespace Database\Seeders;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Database\Seeder;

class TelegraphBotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $bot1 = TelegraphBot::create([
            'token' => '5704695558:AAF2dCKZTyHqSXdwi6Nm8R73sHbt7oYtFHk',
            'name' => 'Volleyball Tronadora Bot',
        ]);

    }
}
