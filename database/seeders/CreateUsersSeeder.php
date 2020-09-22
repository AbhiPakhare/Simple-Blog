<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'author',
                'email' => 'author@gmail.com',
                'is_author' => '1',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'guest',
                'email' => 'guest@gmail.com',
                'is_author' => '0',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
