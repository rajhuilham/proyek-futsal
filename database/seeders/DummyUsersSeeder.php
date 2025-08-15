<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Mas Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('admin123')
            ],
             [
                'name' => 'Mas User',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'password' => bcrypt('user123')
            ],
             [
                'name' => 'Mas Member',
                'email' => 'member@gmail.com',
                'role' => 'member',
                'password' => bcrypt('member123')
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
