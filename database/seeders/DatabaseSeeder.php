<?php

namespace Database\Seeders;

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
        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(CartographerSeeder::class);
        $this->call(UserSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();

    }
}
