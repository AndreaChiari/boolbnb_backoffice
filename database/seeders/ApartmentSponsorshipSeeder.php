<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $apartments = Apartment::pluck('id')->toArray();
        $sponsorships = Sponsorship::pluck('id')->toArray();
        $max_sponsorships = count($sponsorships) - 1;

        foreach ($apartments as $apartment) {
            if ($faker->boolean()) {
                $current_apartment = Apartment::find($apartment);
                $sponsorship = $sponsorships[$faker->numberBetween(0, $max_sponsorships)];
                $sponsorship_duration = Sponsorship::find($sponsorship)->duration;
                $start_date = now();
                $end_date = date_add(now(), date_interval_create_from_date_string("$sponsorship_duration hours"));
                $current_apartment->sponsorships()->attach($sponsorship, ['start_date' => $start_date, 'end_date' => $end_date]);
            }
        }
    }
}
