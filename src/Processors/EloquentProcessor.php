<?php

namespace Noitran\RQL\Processors;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Expressions\AndExpr;
use Noitran\RQL\Expressions\OrExpr;
use Noitran\RQL\ExprQueue;

/**
 * Class EloquentProcessor
 */
class EloquentProcessor implements ProcessorInterface
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected static $methodMap = [
        '$eq' => 'where',
        '$notEq' => 'where',
        '$lt' => 'where',
        '$lte' => 'where',
        '$gt' => 'where',
        '$gte' => 'where',
        '$like' => 'where',

        '$in' => 'whereIn',
        '$notIn' => 'whereNotIn',
        '$between' => 'whereBetween',

        '$or' => null,
        '$and' => null,
    ];

    /**
     * @var array
     */
    protected static $comparisonMethods = [
        '$eq',
        '$notEq',
        '$lt',
        '$lte',
        '$gt',
        '$gte',
        '$like',
    ];

    /**
     * EloquentProcessor constructor.
     *
     * @param Builder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return Builder|Model
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @param ExprQueue $exprClasses
     *
     * @return Builder
     */
    public function process(ExprQueue $exprClasses): Builder
    {
        foreach ($exprClasses as $exprClass) {
            /** @var ExprInterface $exprClass */
            if (in_array($exprClass->getExpression(), self::$comparisonMethods, true)) {
                return $this->applyComparison($exprClass);
            }

            if (in_array($exprClass->getExpression(), ['$in', '$notIn', '$between'], true)) {
                return $this->applyIfValueIsArray($exprClass);
            }

//            if ($exprClass instanceof LikeExpr) {
//                return $this->applyLike($exprClass);
//            }

            if ($exprClass instanceof OrExpr) {
                return $this->applyOr($exprClass);
            }

            if ($exprClass instanceof AndExpr) {
                return $this->applyAnd($exprClass);
            }
        }

        return $this->getBuilder();
    }

    /**
     * @param ExprInterface $exprClass
     *
     * @return Builder
     */
    protected function applyComparison(ExprInterface $exprClass): Builder
    {
        $method = self::$methodMap[$exprClass->getExpression()];

        return $this->getBuilder()->{$method}(
            $exprClass->getColumn(),
            $exprClass->getOperator(),
            $exprClass->getValue()
        );
    }

    /**
     * @param ExprInterface $exprClass
     *
     * @return Builder
     */
    protected function applyIfValueIsArray(ExprInterface $exprClass): Builder
    {
        $method = self::$methodMap[$exprClass->getExpression()];

        return $this->getBuilder()->{$method}(
            $exprClass->getColumn(),
            $exprClass->getValue()
        );
    }

    /**
     * @param ExprInterface $exprClass
     *
     * @return Builder
     */
    protected function applyOr(ExprInterface $exprClass): Builder
    {
    }

    /**
     * @param ExprInterface $exprClass
     *
     * @return Builder
     */
    protected function applyAnd(ExprInterface $exprClass): Builder
    {
    }
}
