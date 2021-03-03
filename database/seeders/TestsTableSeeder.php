<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{
    public function run()
    {
        Test::create([
            'name' => [
                'ar' => 'كوفيد 19',
                'en' => 'Covid 19'
            ], 'description' => 'N/A'
        ]);
        Test::create([
            'name' => [
                'ar' => 'ماسح الصدر',
                'en' => 'Scanner Thoracique	'
            ], 'description' => 'N/A'
        ]);
    }
}
