<?php

declare(strict_types=1);

namespace Noitran\RQL;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Services\RQLService;

/**
 * Class ServiceProvider.
 */
class ServiceProvider extends IlluminateServiceProvider
{
    public function boot(): void
    {
        $this->publishConfig();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();
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

    protected function publishConfig(): void
    {
        $configPath = __DIR__ . '/../config/rql.php';
        if (\function_exists('config_path')) {
            $publishPath = config_path('rql.php');
        } else {
            $publishPath = base_path('config/rql.php');
        }

        $this->publishes([$configPath => $publishPath], 'config');
    }

    protected function registerConfig(): void
    {
        $configPath = __DIR__ . '/../config/rql.php';
        $this->mergeConfigFrom($configPath, 'rql');
    }

    /**
     * Bind the RQL service as singleton.
     */
    protected function registerService(): void
    {
        $this->app->singleton(RQLService::class);
        $this->app->alias(RQLService::class, 'rql');
    }

    /**
     * Bind ORM implementation to Processor.
     */
    protected function bindProcessor(): void
    {
        $this->app->bind(ProcessorInterface::class, function () {
            return rql()->getProcessor();
        });
    }
}
