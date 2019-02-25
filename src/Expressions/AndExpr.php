<?php

namespace Noitran\RQL\Expressions;

/**
 * Class AndExpr
 */
class AndExpr extends AbstractExpr
{
    /**
     * AndExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$and');
        $this->setOperator();
    }
}
