<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Seeder;

class ConstantsTableSeeder extends Seeder
{
    public function run()
    {
        $ref1['name'] = [
            'ar' => 'ذكر',
            'en' => 'Male'
        ];

        Constant::create($ref1);

        $ref2['name'] = [
            'ar' => 'أنثى',
            'en' => 'Female'
        ];

        Constant::create($ref2);
    }
}
