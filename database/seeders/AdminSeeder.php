<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'hamidabdulaziz336@gmail.com',
            'password' => bcrypt('£#Vf8KH3!g1-'),
        ]);
    }
}
