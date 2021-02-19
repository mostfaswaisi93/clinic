<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        Country::create([
            'name' => [
                'ar' => 'أفغانستان',
                'en' => 'Afghanistan'
            ],
            'currency' => [
                'ar' => 'أفغاني',
                'en' => 'AFN'
            ],
            'iso_code' => '15.00', 'phone_code' => '93'
        ]);
    }
}
