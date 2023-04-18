<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\View;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $apartment_ids = Apartment::pluck('id')->toArray();
        $max = count($apartment_ids) - 1;

        for ($i = 0; $i < 2000; $i++) {
            $new_view = new View();

            $new_view->apartment_id = $apartment_ids[$faker->numberBetween(0, $max)];
            $new_view->date = $faker->dateTimeInInterval('-2 weeks', '+2 weeks');
            $new_view->ip = $faker->ipv4();

            $new_view->save();
        }
    }
}
