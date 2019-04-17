<?php

declare(strict_types=1);

namespace Noitran\RQL\Tests;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Noitran\RQL\ServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * Class TestCase.
 */
abstract class TestCase extends OrchestraTestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->registerEloquentFactoriesFrom(__DIR__ . '/database/factories');

        $this->artisan('db:seed', [
            '--class' => PostTestSeeder::class,
        ]);
    }

    /**
     * @param \Laravel\Lumen\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }

    /**
     * Register factories.
     *
     * @param string $path
     */
    protected function registerEloquentFactoriesFrom($path): void
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}
