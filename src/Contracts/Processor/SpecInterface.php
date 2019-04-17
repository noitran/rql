<?php

declare(strict_types=1);

namespace Noitran\RQL\Contracts\Processor;

use Noitran\RQL\Contracts\Expression\ExprInterface;

interface SpecInterface
{
    /**
     * @param ProcessorInterface $processor
     * @param ExprInterface $exprClass
     *
     * @return bool
     */
    public function isSatisfiedBy(ProcessorInterface $processor, ExprInterface $exprClass): bool;

    /**
     * @param ProcessorInterface $processor
     * @param ExprInterface $exprClass
     *
     * @return mixed
     */
    public function apply(ProcessorInterface $processor, ExprInterface $exprClass);
}
