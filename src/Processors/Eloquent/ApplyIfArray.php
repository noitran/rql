<?php

namespace Noitran\RQL\Processors\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\ApplicableInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;

/**
 * Class ApplyIfArray
 */
class ApplyIfArray implements ApplicableInterface
{
    /**
     * @inheritdoc
     */
    public function supports(ProcessorInterface $processor, ExprInterface $exprClass): bool
    {
        if (! in_array($exprClass->getExpression(), ['$in', '$notIn', '$between'], true)) {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function apply(ProcessorInterface $processor, ExprInterface $exprClass): Builder
    {
        /** @var EloquentProcessor $processor */
        $method = $processor::getMethodMap()[$exprClass->getExpression()];

        return $processor->getBuilder()->{$method}(
            $exprClass->getColumn(),
            $exprClass->getValue()
        );
    }
}
