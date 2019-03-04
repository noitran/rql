<?php

namespace Noitran\RQL\Processors;

use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\ApplicableInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Contracts\Resolver\ResolverInterface;
use Noitran\RQL\Exceptions\ExpressionException;

class FilterStrategyResolver implements ResolverInterface
{
    /**
     * @var ApplicableInterface[]
     */
    protected $applicableStrategies = [];

    /**
     * @inheritdoc
     */
    public function registerAll(array $filterStrategies): self
    {
        foreach ($filterStrategies as $strategy) {
            $this->register($strategy);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function register(string $filterStrategy): self
    {
        $this->applicableStrategies[] = new $filterStrategy();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function resolve(ProcessorInterface $processor, ExprInterface $exprClass): ApplicableInterface
    {
        foreach ($this->applicableStrategies as $strategy) {
            if ($strategy->supports($processor, $exprClass)) {
                return $strategy;
            }
        }

        throw new ExpressionException(
            'Can\'t find how to apply operator defined in class: ' . get_class($exprClass)
        );
    }
}
