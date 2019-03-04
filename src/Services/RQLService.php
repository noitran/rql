<?php

namespace Noitran\RQL\Services;

use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Illuminate\Contracts\Config\Repository as Config;
use Noitran\RQL\Contracts\Resolver\ResolverInterface;
use Noitran\RQL\Exceptions\RuntimeException;
use Noitran\RQL\Processors\FilterStrategyResolver;

/**
 * Class RQLService
 */
class RQLService
{
    /**
     * @var ProcessorInterface|null
     */
    protected $processor;

    /**
     * @var Config
     */
    protected $config;

    /**
     * RQLService constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return ProcessorInterface
     */
    public function getProcessor(): ProcessorInterface
    {
        if (! $this->processor) {
            $this->processor = $this->createProcessor();
        }

        return $this->processor;
    }

    /**
     * @return ProcessorInterface
     */
    protected function createProcessor(): ProcessorInterface
    {
        $name = $this->config->get('rql.default_processor', 'eloquent');
        $class = config("rql.processors.{$name}.class");

        if (! class_exists($class)) {
            throw new RuntimeException('Processor class "' . $class . '" does not exist!');
        }

        $resolver = $this->createFilterStrategyResolver($this->getConfig($name));

        return new $class($resolver);
    }

    /**
     * @param array $config
     *
     * @return ResolverInterface
     */
    protected function createFilterStrategyResolver(array $config): ResolverInterface
    {
        return (new FilterStrategyResolver())
            ->registerAll($config['filter_strategies']);
    }

    /**
     * @param string $processorName
     *
     * @return array
     */
    protected function getConfig(string $processorName = 'eloquent'): array
    {
        $config = (array) $this->config->get('rql');

        if (empty($config)) {
            throw new RuntimeException('RQL config does not exist.');
        }

        return $config['processors'][$processorName];
    }
}
