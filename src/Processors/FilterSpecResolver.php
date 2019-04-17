<?php

declare(strict_types=1);

namespace Noitran\RQL\Processors;

use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Contracts\Processor\SpecInterface;
use Noitran\RQL\Contracts\Resolver\ResolverInterface;
use Noitran\RQL\Exceptions\ExpressionException;

class FilterSpecResolver implements ResolverInterface
{
    /**
     * @var SpecInterface[]
     */
    protected $applicableSpecs = [];

    /**
     * {@inheritdoc}
     */
    public function registerAll(array $filterSpecs): self
    {
        foreach ($filterSpecs as $spec) {
            $this->register($spec);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function register(string $filterStrategy): self
    {
        $this->applicableSpecs[] = new $filterStrategy();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(ProcessorInterface $processor, ExprInterface $exprClass): SpecInterface
    {
        foreach ($this->applicableSpecs as $spec) {
            if ($spec->isSatisfiedBy($processor, $exprClass)) {
                return $spec;
            }
        }

        throw new ExpressionException(
            'Can\'t find how to apply operator defined in class: ' . \get_class($exprClass)
        );
    }
}
