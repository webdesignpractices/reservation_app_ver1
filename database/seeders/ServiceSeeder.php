<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'カット',
            'duration_minutes' => 60,
            'price' => 5000,
        ]);
        Service::create([
            'name' => 'カラー(ブリーチなし)', 'price' => 10000, 'duration_minutes' => 90,
        ]);
        Service::create([
            'name' => 'カラー(ブリーチあり)', 'price' => 15000, 'duration_minutes' => 120,
        ]);
        Service::create([
            'name' => '縮毛矯正(カットなし)', 'price' => 16500, 'duration_minutes' => 150,
        ]);
        Service::create(['name' => '縮毛矯正(カットあり)', 'price' => 18000, 'duration_minutes' => 180,
        ]);
        Service::create(['name' => '前髪カット', 'price' => 1000, 'duration_minutes' => 30,
        ]);
        Service::create(['name' => 'ヘッドスパ', 'price' => 5000, 'duration_minutes' => 60,
        ]);
    }
}
