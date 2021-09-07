<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! $user = User::where('email', 'admin@uvers.ac.id')->first()) {
            $user = User::create([
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@uvers.ac.id',
                'password' => bcrypt('12345678'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
        

    }
}
