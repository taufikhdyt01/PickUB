<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
                'name' => 'User One',
                'image_url' => 'media/default.jpeg'
            ],
            [
                'username' => 'user2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'name' => 'User Two',
                'image_url' => 'media/default.jpeg'
            ],
            [
                'username' => 'user3',
                'email' => 'user3@example.com',
                'password' => Hash::make('password'),
                'name' => 'User Three',
                'image_url' => 'media/default.jpeg'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
