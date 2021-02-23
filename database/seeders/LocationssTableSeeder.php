<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use Illuminate\Database\Seeder;

class LocationssTableSeeder extends Seeder
{
    public function run()
    {
        $country01 = Country::create([
            'name' => [
                'ar' => 'السعودية',
                'en' => 'Saudi Arabia'
            ]
        ]);
        $city011 = City::create([
            'name' => [
                'ar' => 'الرياض',
                'en' => 'Riyadh'
            ], 'country_id' => $country01->id
        ]);
        $district0111 = District::create([
            'name' => [
                'ar' => 'الملاذ',
                'en' => 'Al Malaz'
            ], 'country_id' => $country01->id, 'city_id' => $city011->id
        ]);
        $district0112 = District::create([
            'name' => [
                'ar' => 'الشميسي',
                'en' => 'Al Shemaysi'
            ], 'country_id' => $country01->id, 'city_id' => $city011->id
        ]);
        $district0113 = District::create([
            'name' => [
                'ar' => 'العليا',
                'en' => 'Al Olyya'
            ], 'country_id' => $country01->id, 'city_id' => $city011->id
        ]);
        $city012 = City::create([
            'name' => [
                'ar' => 'جدة',
                'en' => 'Jeddah'
            ], 'country_id' => $country01->id
        ]);
        $district0121 = District::create([
            'name' => [
                'ar' => 'المرجان',
                'en' => 'Al Morjan'
            ], 'country_id' => $country01->id, 'city_id' => $city012->id
        ]);
        $district0122 = District::create([
            'name' => [
                'ar' => 'الخالدية',
                'en' => 'Al Khaldeyyah'
            ], 'country_id' => $country01->id, 'city_id' => $city012->id
        ]);
        $district0123 = District::create([
            'name' => [
                'ar' => 'السلامة',
                'en' => 'Al Salamah'
            ], 'country_id' => $country01->id, 'city_id' => $city012->id
        ]);
        $city013 = City::create([
            'name' => [
                'ar' => 'الدمام',
                'en' => 'Dammam'
            ], 'country_id' => $country01->id
        ]);
        $district0131 = District::create([
            'name' => [
                'ar' => 'الفيصلية',
                'en' => 'Al Fesaleyyah'
            ], 'country_id' => $country01->id, 'city_id' => $city013->id
        ]);
        $district0132 = District::create([
            'name' => [
                'ar' => 'الفاخرية',
                'en' => 'Al Fakhreyyah'
            ], 'country_id' => $country01->id, 'city_id' => $city013->id
        ]);
        $district0133 = District::create([
            'name' => [
                'ar' => 'الشاطئ',
                'en' => 'Al Shatea'
            ], 'country_id' => $country01->id, 'city_id' => $city013->id
        ]);

        $country02 = Country::create([
            'name' => [
                'ar' => 'مصر',
                'en' => 'Egypt'
            ]
        ]);
        $city021 = City::create([
            'name' => [
                'ar' => 'القاهرة',
                'en' => 'Cairo'
            ], 'country_id' => $country02->id
        ]);
        $district0211 = District::create([
            'name' => [
                'ar' => 'الزمالك',
                'en' => 'Al Zamalik'
            ], 'country_id' => $country02->id, 'city_id' => $city021->id
        ]);
        $district0212 = District::create([
            'name' => [
                'ar' => 'الشميسي',
                'en' => 'Al Shemaysi'
            ], 'country_id' => $country02->id, 'city_id' => $city021->id
        ]);
        $district0213 = District::create([
            'name' => [
                'ar' => 'الملاذ',
                'en' => 'Al Malaz'
            ], 'country_id' => $country02->id, 'city_id' => $city021->id
        ]);
        $city022 = City::create([
            'name' => [
                'ar' => 'الأسكندرية',
                'en' => 'Alexandria'
            ], 'country_id' => $country02->id
        ]);
        $district0221 = District::create([
            'name' => [
                'ar' => 'وسط الأسكندرية',
                'en' => 'Al Alexandria Center'
            ], 'country_id' => $country02->id, 'city_id' => $city022->id
        ]);
        $district0222 = District::create([
            'name' => [
                'ar' => 'شرق الأسكندرية',
                'en' => 'Al Alexandria East'
            ], 'country_id' => $country02->id, 'city_id' => $city022->id
        ]);
        $district0223 = District::create([
            'name' => [
                'ar' => 'غرب الأسكندرية',
                'en' => 'Al Alexandria West'
            ], 'country_id' => $country02->id, 'city_id' => $city022->id
        ]);
        $city023 = City::create([
            'name' => [
                'ar' => 'الجيزة',
                'en' => 'Giza'
            ], 'country_id' => $country02->id
        ]);
        $district0221 = District::create([
            'name' => [
                'ar' => 'الدقي',
                'en' => 'Al Doggi'
            ], 'country_id' => $country02->id, 'city_id' => $city023->id
        ]);
        $district0222 = District::create([
            'name' => [
                'ar' => 'العجوزة',
                'en' => 'Al Agoozah'
            ], 'country_id' => $country02->id, 'city_id' => $city023->id
        ]);
        $district0223 = District::create([
            'name' => [
                'ar' => 'الهرم',
                'en' => 'Al Haram'
            ], 'country_id' => $country02->id, 'city_id' => $city023->id
        ]);

        $country03 = Country::create([
            'name' => [
                'ar' => 'فلسطين',
                'en' => 'Palestine'
            ]
        ]);
        $city031 = City::create([
            'name' => [
                'ar' => 'القدس',
                'en' => 'Al Quds'
            ], 'country_id' => $country03->id
        ]);
        $district0311 = District::create([
            'name' => [
                'ar' => 'الإسلامي',
                'en' => 'Al Islami'
            ], 'country_id' => $country03->id, 'city_id' => $city031->id
        ]);
        $district0312 = District::create([
            'name' => [
                'ar' => 'الناصرة',
                'en' => 'Al Nasara'
            ], 'country_id' => $country03->id, 'city_id' => $city031->id
        ]);
        $district0313 = District::create([
            'name' => [
                'ar' => 'الأرمان',
                'en' => 'Al Arman'
            ], 'country_id' => $country03->id, 'city_id' => $city031->id
        ]);
        $city032 = City::create([
            'name' => [
                'ar' => 'غزة',
                'en' => 'Gaza'
            ], 'country_id' => $country03->id
        ]);
        $district0321 = District::create([
            'name' => [
                'ar' => 'الرمال',
                'en' => 'Al Remal'
            ], 'country_id' => $country03->id, 'city_id' => $city032->id
        ]);
        $district0322 = District::create([
            'name' => [
                'ar' => 'تل الهوى',
                'en' => 'Tal Alhawa'
            ], 'country_id' => $country03->id, 'city_id' => $city032->id
        ]);
        $district0323 = District::create([
            'name' => [
                'ar' => 'النصر',
                'en' => 'Al Nasr'
            ], 'country_id' => $country03->id, 'city_id' => $city032->id
        ]);
        $city033 = City::create([
            'name' => [
                'ar' => 'نابلس',
                'en' => 'Nablus'
            ], 'country_id' => $country03->id
        ]);
        $district0331 = District::create([
            'name' => [
                'ar' => 'الحبلة',
                'en' => 'Al Habalah'
            ], 'country_id' => $country03->id, 'city_id' => $city033->id
        ]);
        $district0332 = District::create([
            'name' => [
                'ar' => 'تل العقبة',
                'en' => 'Tal Aqabah'
            ], 'country_id' => $country03->id, 'city_id' => $city033->id
        ]);
        $district0333 = District::create([
            'name' => [
                'ar' => 'الغرب',
                'en' => 'Al Gharb'
            ], 'country_id' => $country03->id, 'city_id' => $city033->id
        ]);
    }
}
