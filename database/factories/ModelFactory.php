<?php

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'designation'   => $faker->sentence,
        'company'   => $faker->company,
        'about' => $faker->paragraph,
        'remember_token' => str_random(10),
        'api_token' => str_random(60)
    ];
});

$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
    return [
        'eventDate'  => $faker->date,
        'description' => 'All delegates do something',
    ];
});

$factory->define(App\Agenda::class, function (Faker\Generator $faker) {
    return [
        'time'  => $faker->time,
        'venue' => $faker->sentence,
        'title' => $faker->sentence,
        'description'   => $faker->paragraph,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'title'  => $faker->word,
    ];
});

$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
    return [
        'eventDate'  => $faker->date,
    ];
});

$factory->define(App\Agenda::class, function (Faker\Generator $faker) {
    return [
        'schedule_id'   => 1,
        'time'  => sprintf('%s - %s', $faker->time, $faker->time),
        'venue' => $faker->streetName,
        'title' => $faker->sentence,
        'description' => $faker->paragraph(10)
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'standNumber'  => $faker->randomNumber(3),
        'description'   => $faker->paragraph,
    ];
});

$factory->define(App\Thread::class, function (Faker\Generator $faker) {
    return [
        'subject' => $faker->sentence,
    ];
});

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        'message' => $faker->sentence,
    ];
});