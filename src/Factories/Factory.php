<?php

namespace Noitran\RQL\Factories;

use Illuminate\Contracts\Container\Container as IlluminateContainer;

/**
 * Class Factory
 */
class Factory
{
    /**
     * @var IlluminateContainer
     */
    protected $container;

    /**
     * Factory constructor.
     *
     * @param IlluminateContainer $container
     */
    public function __construct(IlluminateContainer $container)
    {
        $this->container = $container;
    }
}
