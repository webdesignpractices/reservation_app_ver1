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
        Staff::updateOrCreate(
            ['staff_code' => 'L001'],
            ['name' => '山本雅人',
            'description' => '店長です。歴12年。縮毛矯正、艶カラーが得意です！縮毛矯正のリピート率95%です！',
            'status' => StaffStatus::Active,
        ]);
        Staff::updateOrCreate(
            ['staff_code' => 'A001'],
            ['name' => '小林杏奈',
            'description' => '歴8年。ショート、ボブ、似合わせカットが得意です！',
            'status' => StaffStatus::Active,
        ]);
    }
}
