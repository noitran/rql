<?php

declare(strict_types=1);

namespace Noitran\RQL\Processors\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Contracts\Processor\SpecInterface;
use Noitran\RQL\Expressions\OrExpr;

/**
 * Class ApplyOr.
 */
class ApplyOr implements SpecInterface
{
    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy(ProcessorInterface $processor, ExprInterface $exprClass): bool
    {
        if (! $exprClass instanceof OrExpr) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(ProcessorInterface $processor, ExprInterface $exprClass): Builder
    {
        /* @var EloquentProcessor $processor */
        return $processor->getBuilder()->where(function (Builder $builder) use ($exprClass) {
            $values = $exprClass->getValue();

            foreach ($values as $value) {
                $builder->orWhere($exprClass->getColumn(), $value);
            }

            return $builder;
        });
    }
}
