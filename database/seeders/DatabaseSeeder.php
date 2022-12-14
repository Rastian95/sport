<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TelegraphBotSeeder::class);
        $this->call(TelegraphChatSeeder::class);
        $this->call(PlayerSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(EventDetailSeeder::class);
    }
}
