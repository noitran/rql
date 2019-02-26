<?php

namespace Noitran\RQL\Expressions;

/**
 * Class LikeExpr
 */
class LikeExpr extends AbstractExpr
{
    /**
     * LikeExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$like');
        $this->setOperator('like');
    }
}
