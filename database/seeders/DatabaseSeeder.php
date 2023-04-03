<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ApartmentSeeder::class,
            SponsorshipSeeder::class,
            ServiceSeeder::class,
            MessageSeeder::class,
            ViewSeeder::class,
            ApartmentServiceSeeder::class,
            ApartmentSponsorshipSeeder::class,
        ]);
    }
}
