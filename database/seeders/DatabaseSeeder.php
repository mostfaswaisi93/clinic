<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SpatieSeeder::class,
            UsersTableSeeder::class,
            // ContactsTableSeeder::class,
            // CountriesTableSeeder::class,
            // CitiesTableSeeder::class,
            // WeightsTableSeeder::class,
            // TradeMarksTableSeeder::class,
        ]);
    }
}
