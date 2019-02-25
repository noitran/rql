<?php

namespace Noitran\RQL\Expressions;

/**
 * Class NotEqExpr
 */
class NotEqExpr extends AbstractExpr
{
    /**
     * NotEqExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$notEq');
        $this->setOperator('!=');
    }
}
