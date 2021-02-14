<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
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
