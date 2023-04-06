<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Apartment;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder



{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $apartments = config('apartments');
        $users = User::pluck('id')->toArray();
        $max_user = count($users) - 1;

        foreach ($apartments as $apartment) {
            sleep(1);
            $new_apartment = new Apartment();
            $new_apartment->user_id = $users[$faker->numberBetween(0, $max_user)];
            $new_apartment->name = $apartment['name'];
            $new_apartment->price = $apartment['price'];
            $new_apartment->rooms = $apartment['rooms'];
            $new_apartment->beds = $apartment['beds'];
            $new_apartment->bathrooms = $apartment['bathrooms'];
            $new_apartment->square_meters = $apartment['square_meters'];
            $new_apartment->address = $apartment['address'];
            $new_apartment->thumb = $apartment['thumb'];
            $new_apartment->description = $apartment['description'];

            $new_apartment->save();
        }
    }
}
