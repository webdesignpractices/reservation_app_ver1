<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Enums\StaffStatus;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::create([
            'staff_code' => 'L001',
            'name' => '山本雅人',
            'description' => '店長です。歴12年。カウンセリングをしっかり行い、お客様に満足していただけるよう頑張っています！',
            'status' => StaffStatus::Active,
        ]);
        Staff::create([
            'staff_code' => 'A001',
            'name' => '小林杏奈',
            'description' => 'アシスタントをしています。シャンプー、ヘッドスパが好評です！',
            'status' => StaffStatus::Active,
        ]);
    }
}
