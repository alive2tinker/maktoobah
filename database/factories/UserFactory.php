<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    $dateOfBirth = $faker->dateTimeBetween('1970-01-01', '2002-12-31')
        ->format('Y-m-d');
    $age = \Carbon\Carbon::parse($dateOfBirth)->age;
    return [
        'name' => $faker->name($gender),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'city_id' => $faker->numberBetween(1,210),
        'gender' => $gender,
        'nationality' => $faker->randomElement(['Saudi','Bahraini','Emirati','Kuwaiti','Omani']),
        'dob' => $dateOfBirth,
        'height' => $faker->numberBetween(150,210),
        'weight' => $faker->numberBetween(49,200),
        'skin_color' => $faker->randomElement(['white','light black','black']),
        'tribal' => $faker->boolean(30),
        'hair_color' => $faker->randomElement(['black','blonde','red','white']),
        'hair_type' => $faker->randomElement(['straight','curly']),
        'eye_color' => $faker->randomElement(['black','blue','brown']),
        'marital_status' => $faker->randomElement(['single','married','divorced','widowed']),
        'job' => $faker->jobTitle,
        'education' => $faker->randomElement(['high_school','bachelors','masters','doctorate']),
        'smoker' => $faker->boolean(0.125),
        'details' => $faker->sentences($faker->numberBetween(3, 10), true),
        'polygamy_friendly' => $faker->boolean(0.125),
        'misyar_friendly' => $faker->boolean(0.125),
        'age' => $age
    ];
});
