<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\StaffSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            StaffSeeder::class,
            ServiceSeeder::class,
            AdminSeeder::class,
            
        ]);
    }
}
