<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
            'id_number' => $this->faker->unique()->creditCardNumber,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,

        ];
    }

    // $factory->define(Patient::class, function (Faker $faker) {
    //     $gender = $faker->randomElement(['male', 'female']);
    //     return [
    //         'name' => $faker->name,
    //         'email' => $faker->safeEmail,
    //         'aderss'=>$faker->address,
    //         'phone'=>$faker->randomNumber,
    //         'gender'=>$gender,
    //         'DOB'=>$faker->date($format = 'Y-m-d', $max = 'now'),
    //         'user_id' => function () {
    //             return factory(App\User::class)->create()->id;
    //         },
    //     ];
    // });
}
