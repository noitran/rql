<?php

declare(strict_types=1);

namespace Noitran\RQL\Tests;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Noitran\RQL\Tests\Stubs\Models\User;

class PostTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* @var Faker $faker */
        // $faker = app(Faker::class);

        factory(User::class, 5)->create()->map(function (User $person) {
            return $person->getKey();
        })->all();
    }
}
