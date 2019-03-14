<?php

namespace Noitran\RQL\Processors\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\SpecInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Expressions\BetweenExpr;

/**
 * Class ApplyBetween
 */
class ApplyBetween implements SpecInterface
{
    /**
     * @inheritdoc
     */
    public function isSatisfiedBy(ProcessorInterface $processor, ExprInterface $exprClass): bool
    {
        if (! $exprClass instanceof BetweenExpr) {
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
        return $processor->getBuilder()->whereBetween(
            $exprClass->getColumn(),
            $exprClass->getValue()
        );
    }
}
