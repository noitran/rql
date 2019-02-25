<?php

namespace Noitran\RQL\Expressions;

/**
 * Class OrExpr
 */
class OrExpr extends AbstractExpr
{
    /**
     * OrExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$or');
        $this->setOperator();
    }
}
