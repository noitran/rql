<?php

namespace Noitran\RQL\Processors\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Exceptions\ExpressionException;
use Noitran\RQL\Processors\FilterSpecResolver;
use Noitran\RQL\Queues\ExprQueue;

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
     * @var FilterSpecResolver
     */
    protected $resolver;

    /**
     * @var array
     */
    public static $methodMap = [
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
    ];

    /**
     * @var array
     */
    public static $comparisonMethods = [
        '$eq',
        '$notEq',
        '$lt',
        '$lte',
        '$gt',
        '$gte',
        '$like',
    ];

    /**
     * @return array
     */
    public static function getMethodMap(): array
    {
        return self::$methodMap;
    }

    /**
     * @return array
     */
    public static function getComparisonMethods(): array
    {
        return self::$comparisonMethods;
    }

    /**
     * EloquentProcessor constructor.
     *
     * @param FilterSpecResolver $resolver
     */
    public function __construct(FilterSpecResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @return Builder|Model
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @param Builder $builder
     *
     * @return EloquentProcessor
     */
    public function setBuilder(Builder $builder): self
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * @param ExprQueue $exprClasses
     *
     * @throws ExpressionException
     *
     * @return Builder
     */
    public function process(ExprQueue $exprClasses): Builder
    {
        foreach ($exprClasses as $exprClass) {
            /** @var ExprInterface $exprClass */
            $this->builder = $this->resolver
                ->resolve($this, $exprClass)
                ->apply($this, $exprClass);
        }

        return $this->builder;
    }
}
