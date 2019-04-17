<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/* @var EloquentFactory $factory */

/* User */
$factory->define(Noitran\RQL\Tests\Stubs\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => str_random(10),
        'last_logged_in_at' => \Carbon\Carbon::now(),
    ];
});
