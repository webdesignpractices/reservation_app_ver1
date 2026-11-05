<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create(['name' => '山本雅人',
        'staff_code' => 'L001',
        'password' => 'owner@example.com',
        ]);
    }
}
