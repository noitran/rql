<?php

namespace Noitran\RQL\Contracts\Resolver;

use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\ApplicableInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Exceptions\ExpressionException;

/**
 * Interface ResolverInterface
 */
interface ResolverInterface
{
    /**
     * @param array $filterStrategies
     *
     * @return mixed
     */
    public function registerAll(array $filterStrategies);

    /**
     * @param string $filterStrategy
     *
     * @return mixed
     */
    public function register(string $filterStrategy);

    /**
     * @param ProcessorInterface $processor
     * @param ExprInterface $exprClass
     *
     * @throws ExpressionException
     *
     * @return ApplicableInterface
     */
    public function resolve(ProcessorInterface $processor, ExprInterface $exprClass): ApplicableInterface;
}
