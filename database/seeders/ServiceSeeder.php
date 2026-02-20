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
            'name' => 'カラー(ブリーチなし)',
            'duration_minutes' => 90,
            'price' => 8000,
        ]);
        Service::create([
            'name' => 'カラー(ブリーチなあり)',
            'duration_minutes' => 120,
            'price' => 13000,
        ]);
        Service::create([
            'name' => '縮毛矯正',
            'duration_minutes' => 180,
            'price' => 18000,
        ]);

    }
}
