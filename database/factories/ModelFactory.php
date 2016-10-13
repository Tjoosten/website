<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\Rental::class, function (Faker\Generator $faker) {
    return [
        'start_date'   => $faker->word,
        'end_date'     => $faker->word,
        'group'        => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'email'        => $faker->email
    ];

});

$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    // $faker->unixTime($max = 'now')                 -> (timestamp) 58781813
    // $faker->time($format = 'H:i:s', $max = 'now')  -> '20:49:42'

    return [
        'user_id'     => factory(App\User::class)->create(['id' => 4])->id,
        'heading'     => $faker->text(200),
        'description' => $faker->text(200),
        'date'        => Carbon::now(),
        'start_time'  => Carbon::now(),
        'end_time'    => Carbon::now(),
        'state'       => 1,
    ];
});

$factory->define(App\Groups::class, function (Faker\Generator $faker) {
    return [
        'selector'    => $faker->name,
        'sub_heading' => $faker->name,
        'heading'     => $faker->name,
        'description' => $faker->name
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $themes = array('skin-black','skin-black-light','skin-blue','skin-blue-light','skin-green','skin-green-light','skin-purple','skin-purple-light','skin-red','skin-red-light','skin-yellow','skin-yellow-light');

    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'theme'          => array_rand($themes),
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
