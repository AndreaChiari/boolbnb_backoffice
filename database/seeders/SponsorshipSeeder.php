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
        $sponsorship = new Sponsorship();
        $sponsorship->name = ['Basic', 'Advanced', 'Professional'];
        $sponsorship->duration = [24, 72, 144];
        $sponsorship->price = [2.99, 5.99, 9.99];
        $sponsorship->icon = ['https://thumbs.dreamstime.com/b/quality-premium-icon-vector-illustration-isolated-quality-premium-icon-vector-illustration-isolated-white-approval-check-sign-181305738.jpg', 'https://cdn-icons-png.flaticon.com/512/1435/1435715.png', 'https://cdn-icons-png.flaticon.com/512/3135/3135783.png'];
        $sponsorship->save();
    }
}
