<?php

namespace Noitran\RQL\Expressions;

/**
 * Class InExpr
 */
class InExpr extends AbstractExpr
{
    /**
     * InExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$in');
        $this->setOperator();
    }
}
