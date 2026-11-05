<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'test1', 
            'email' => 'test1@example.com' ,
            'password' => 'test1@example.com',
            ]);

                User::create([
            'name' => 'test2', 
            'email' => 'test2@example.com' ,
            'password' => 'test2@example.com',
            ]);
    }
}
