<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    public function run()
    {
        Patient::create([
            'name' => [
                'ar' => 'جلسة أولى',
                'en' => 'First Session'
            ], 'price' => '15.00'
        ]);
        Patient::factory()->count(3)->create();
    }
}
