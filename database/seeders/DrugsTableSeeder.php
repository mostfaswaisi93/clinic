<?php

namespace Database\Seeders;

use App\Models\Drug;
use Illuminate\Database\Seeder;

class DrugsTableSeeder extends Seeder
{
    public function run()
    {
        Drug::create([
            'trade_name'        => 'amoxilin',
            'generic_name'      => 'GDI',
            'notes'             => 'N/A'
        ]);
        Drug::create([
            'trade_name'        => 'Asoda',
            'generic_name'      => 'Asírina',
            'notes'             => 'N/A'
        ]);
    }
}
