<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    public function run()
    {
        $country01 = Country::create(['name' => 'Saudi Arabia']);
        $city011 = City::create(['name' => 'Riyadh', 'country_id' => $country01->id]);
        $state0111 = State::create(['name' => 'Al Olyya', 'country_id' => $country01->id, 'city_id' => $city011->id]);
        $state0112 = State::create(['name' => 'Al Shemaysi', 'country_id' => $country01->id, 'city_id' => $city011->id]);
        $state0113 = State::create(['name' => 'Al Malaz', 'country_id' => $country01->id, 'city_id' => $city011->id]);

        $city012 = City::create(['name' => 'Jeddah', 'country_id' => $country01->id]);
        $state0121 = State::create(['name' => 'Al Morjan', 'country_id' => $country01->id, 'city_id' => $city012->id]);
        $state0122 = State::create(['name' => 'Al Khaldeyyah', 'country_id' => $country01->id, 'city_id' => $city012->id]);
        $state0123 = State::create(['name' => 'Al Salamah', 'country_id' => $country01->id, 'city_id' => $city012->id]);

        $city013 = City::create(['name' => 'Dammam', 'country_id' => $country01->id]);
        $state0131 = State::create(['name' => 'Al Fesaleyyah', 'country_id' => $country01->id, 'city_id' => $city013->id]);
        $state0132 = State::create(['name' => 'Al Fakhreyyah', 'country_id' => $country01->id, 'city_id' => $city013->id]);
        $state0133 = State::create(['name' => 'Al Shatea', 'country_id' => $country01->id, 'city_id' => $city013->id]);

        $country02 = Country::create(['name' => 'Egypt']);
        $city021 = City::create(['name' => 'Cairo', 'country_id' => $country02->id]);
        $state0211 = State::create(['name' => 'Al Zamalik', 'country_id' => $country02->id, 'city_id' => $city021->id]);
        $state0212 = State::create(['name' => 'Al Shemaysi', 'country_id' => $country02->id, 'city_id' => $city021->id]);
        $state0213 = State::create(['name' => 'Al Malaz', 'country_id' => $country02->id, 'city_id' => $city021->id]);

        $city022 = City::create(['name' => 'Alexandria', 'country_id' => $country02->id]);
        $state0221 = State::create(['name' => 'Al Alexandria Center', 'country_id' => $country02->id, 'city_id' => $city022->id]);
        $state0222 = State::create(['name' => 'Al Alexandria East', 'country_id' => $country02->id, 'city_id' => $city022->id]);
        $state0223 = State::create(['name' => 'Al Alexandria West', 'country_id' => $country02->id, 'city_id' => $city022->id]);

        $city023 = City::create(['name' => 'Giza', 'country_id' => $country02->id]);
        $state0231 = State::create(['name' => 'Al Doggi', 'country_id' => $country02->id, 'city_id' => $city023->id]);
        $state0232 = State::create(['name' => 'Al Agoozah', 'country_id' => $country02->id, 'city_id' => $city023->id]);
        $state0233 = State::create(['name' => 'Al haram', 'country_id' => $country02->id, 'city_id' => $city023->id]);

        $country03 = Country::create(['name' => 'Palestine']);
        $city031 = City::create(['name' => 'Al Quds', 'country_id' => $country03->id]);
        $state0311 = State::create(['name' => 'Al Islami', 'country_id' => $country02->id, 'city_id' => $city031->id]);
        $state0312 = State::create(['name' => 'Al Nasara', 'country_id' => $country02->id, 'city_id' => $city031->id]);
        $state0313 = State::create(['name' => 'Al Arman', 'country_id' => $country02->id, 'city_id' => $city031->id]);

        $city032 = City::create(['name' => 'Gaza', 'country_id' => $country03->id]);
        $state0321 = State::create(['name' => 'Al Remal', 'country_id' => $country02->id, 'city_id' => $city032->id]);
        $state0322 = State::create(['name' => 'Tal Alhawa', 'country_id' => $country02->id, 'city_id' => $city032->id]);
        $state0323 = State::create(['name' => 'Al Nasr', 'country_id' => $country02->id, 'city_id' => $city032->id]);

        $city033 = City::create(['name' => 'Nablus', 'country_id' => $country03->id]);
        $state0331 = State::create(['name' => 'Al Habalah', 'country_id' => $country02->id, 'city_id' => $city033->id]);
        $state0332 = State::create(['name' => 'Tal Aqabah', 'country_id' => $country02->id, 'city_id' => $city033->id]);
        $state0333 = State::create(['name' => 'Al Gharb', 'country_id' => $country02->id, 'city_id' => $city033->id]);
    }
}
