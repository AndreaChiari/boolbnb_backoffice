<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = config('sponsorships');

        foreach ($sponsorships as $sponsorship) {
            $new_sponsorship = new Sponsorship();

            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->duration = $sponsorship['duration'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->icon = $sponsorship['icon'];
            $new_sponsorship->save();
        }
    }
}
