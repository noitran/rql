<?php

namespace Noitran\RQL\Expressions;

/**
 * Class GtExpr
 */
class GtExpr extends AbstractExpr
{
    /**
     * GtExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$gt');
        $this->setOperator('>');
    }
}
