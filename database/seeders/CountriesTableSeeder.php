<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        Country::create([
            'ar' => ['name' => 'أفغانستان', 'currency' => 'أفغاني'],
            'en' => ['name' => 'Afghanistan', 'currency' => 'AFN'],
            'iso_code'      => 'AFG',
            'phone_code'    => '93',
        ]);
    }
}
