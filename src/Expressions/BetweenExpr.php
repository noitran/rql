<?php

namespace Noitran\RQL\Expressions;

/**
 * Class BetweenExpr
 */
class BetweenExpr extends AbstractExpr
{
    /**
     * BetweenExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$between');
        $this->setOperator();
    }
}
