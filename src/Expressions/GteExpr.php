<?php

namespace Noitran\RQL\Expressions;

/**
 * Class GteExpr
 */
class GteExpr extends AbstractExpr
{
    /**
     * GteExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$gte');
        $this->setOperator('>=');
    }
}
