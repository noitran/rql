<?php

namespace Noitran\RQL\Expressions;

/**
 * Class LtExpr
 */
class LtExpr extends AbstractExpr
{
    /**
     * LtExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$lt');
        $this->setOperator('<');
    }
}
