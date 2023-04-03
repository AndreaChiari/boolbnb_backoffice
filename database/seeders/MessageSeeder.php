<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $apartment_ids = Apartment::pluck('id')->toArray();
        $max = count($apartment_ids) - 1;

        for ($i = 0; $i < 10; $i++) {
            $new_message = new Message();

            $new_message->apartment_id = $apartment_ids[$faker->numberBetween(0, $max)];
            $new_message->email = $faker->email();
            $new_message->object = $faker->sentence();
            $new_message->content = $faker->paragraph();

            $new_message->save();
        }
    }
}
