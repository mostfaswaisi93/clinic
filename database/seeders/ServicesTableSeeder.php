<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => [
                'ar' => 'تيست',
                'en' => 'Test'
            ], 'price' => '20'
        ]);
    }
}
