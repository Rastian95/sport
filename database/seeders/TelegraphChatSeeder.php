<?php


namespace Database\Seeders;

use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Seeder;

class TelegraphChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $chat1 = TelegraphChat::create([
            'chat_id' => 1413405776,
            'name' => 'Sebastian',
            'telegraph_bot_id' => 1
        ]);
        $chat2 = TelegraphChat::create([
            'chat_id' => -870090894,
            'name' => 'Volleyball Tronadora',
            'telegraph_bot_id' => 1
        ]);

    }
}
