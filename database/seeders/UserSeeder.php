<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user1 = User::create(
            [
                'name' => 'Sistema',
                'email' => 'cuki10895@gmail.com',
                'password' => Hash::make('giadaniz84'),
            ]
        );

    }
}
