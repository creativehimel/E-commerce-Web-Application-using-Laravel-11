<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'phone' => '12345678901',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'image' => '1.png',
                'role' => 1,
            ],
            [
                'name' => 'Jane Doe',
                'phone' => '12345678901',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 0,
            ],
            [
                'name' => 'Jack Doe',
                'phone' => '12345678901',
                'email' => 'subadmin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 2,
                'image' => '3.png',
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
