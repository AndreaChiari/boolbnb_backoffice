<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = config('users');

        foreach ($users as $user) {
            $new_user = new User();

            $new_user->name = $user['name'];
            $new_user->email = $user['email'];
            $new_user->password = $user['password'];
            $new_user->first_name = $user['first_name'];
            $new_user->last_name = $user['last_name'];
            $new_user->birth_date = $user['birth_date'];

            $new_user->save();
        }
    }
}
