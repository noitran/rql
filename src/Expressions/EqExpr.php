<?php

namespace Noitran\RQL\Expressions;

/**
 * Class EqExpr
 */
class EqExpr extends AbstractExpr
{
    /**
     * EqExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$eq');
        $this->setOperator('=');
    }
}
