<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['staff_code' => 'L001'],
            ['name' => '山本雅人',
            'staff_code' => 'L001',
            'password' => 'owner@example.com',
            'is_admin' => 1,
        ]);
    }
}
