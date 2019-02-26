<?php

namespace Noitran\RQL\Tests;

use Noitran\RQL\Tests\Stubs\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /** @var Faker $faker */
        // $faker = app(Faker::class);

        factory(User::class, 5)->create()->map(function (User $person) {
            return $person->getKey();
        })->all();
    }
}
