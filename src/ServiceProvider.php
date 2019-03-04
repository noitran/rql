<?php

namespace Noitran\RQL;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Factories\Factory;
use Noitran\RQL\Services\RQLService;

/**
 * Class ServiceProvider
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerFactory();
        $this->registerService();
        $this->bindProcessor();
    }

    /**
     * @return string
     */
    protected function getConfigPath(): string
    {
        return __DIR__ . '/../config/repositories.php';
    }

    /**
     * @return void
     */
    protected function publishConfig(): void
    {
        $configPath = __DIR__ . '/../config/rql.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('rql.php');
        } else {
            $publishPath = base_path('config/rql.php');
        }

        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * @return void
     */
    protected function registerConfig(): void
    {
        $configPath = __DIR__ . '/../config/rql.php';
        $this->mergeConfigFrom($configPath, 'rql');
    }

    /**
     * Bind RQL Factory
     *
     * @return void
     */
    protected function registerFactory(): void
    {
        $this->app->singleton(Factory::class, function (Application $app) {
            return new Factory($app);
        });
    }

    /**
     * Bind the RQL service as singleton
     *
     * @return void
     */
    protected function registerService(): void
    {
        $this->app->singleton(RQLService::class);
        $this->app->alias(RQLService::class, 'rql');
    }

    /**
     * Bind ORM implementation to Processor
     *
     * @return void
     */
    protected function bindProcessor(): void
    {
        $this->app->bind(ProcessorInterface::class, function () {
            return rql()->getProcessor();
        });
    }
}
