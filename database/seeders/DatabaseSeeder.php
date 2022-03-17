<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "username"  => "super-admin",
            "name"      => "Super Admin",
            "email"     => "super@admin.dev",
            "password"=> bcrypt("super@admin.dev")
        ]);
        User::factory(5)->create();
        Hospital::factory(10)->create();
        Patient::factory(100)->create();
    }
}
