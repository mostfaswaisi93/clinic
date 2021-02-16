<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Seeder;

class ConstantsTableSeeder extends Seeder
{
    public function run()
    {
        Constant::create([
            'name' => [
                'ar' => 'ذكر',
                'en' => 'Male'
            ], 'type' => 'gender'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'أنثى',
                'en' => 'Female'
            ], 'type' => 'gender'
        ]);
    }
}
