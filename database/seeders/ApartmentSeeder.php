<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartment = new Apartment();
        $apartment->price = 100;
        $apartment->rooms = 5;
        $apartment->beds = 2;
        $apartment->bathrooms = 3;
        $apartment->square_meters = 100;
        $apartment->address = 'Via 2 Giugno, 5, 73048, Nardò';
        $apartment->thumb = 'fanculo';
        $apartment->description = 'dio chencher in memoriam';
        $apartment->save();
    }
}
