<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $apartment_ids = Apartment::pluck('id')->toArray();
        $service_ids = Service::pluck('id')->toArray();
        $max_services = count($service_ids) - 1;

        foreach ($apartment_ids as $apartment) {
            $services = [];
            if ($faker->boolean()) {
                for ($i = 0; $i < $faker->numberBetween(1, $max_services); $i++) {
                    $current_apartment = Apartment::find($apartment);
                    $service_id = $service_ids[$faker->numberBetween(1, $max_services)];
                    if (!in_array($service_id, $services)) {
                        $current_apartment->services()->attach($service_id);
                        $services[] = $service_id;
                    }
                }
            }
        }
    }
}
