<?php

namespace Noitran\RQL\Tests;

use Noitran\RQL\Tests\Stubs\Models\Comment;
use Noitran\RQL\Tests\Stubs\Models\User;
use Noitran\RQL\Tests\Stubs\Models\Post;
use Noitran\RQL\Tests\Stubs\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Collection;

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
