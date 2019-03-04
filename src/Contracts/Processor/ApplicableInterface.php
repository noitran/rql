<?php

namespace Noitran\RQL\Contracts\Processor;

use Noitran\RQL\Contracts\Expression\ExprInterface;

interface ApplicableInterface
{
    /**
     * @param ProcessorInterface $processor
     * @param ExprInterface $exprClass
     *
     * @return bool
     */
    public function supports(ProcessorInterface $processor, ExprInterface $exprClass): bool;

    /**
     * @param ProcessorInterface $processor
     * @param ExprInterface $exprClass
     *
     * @return mixed
     */
    public function apply(ProcessorInterface $processor, ExprInterface $exprClass);
}
