<?php

declare(strict_types=1);

namespace Noitran\RQL\Expressions;

/**
 * Class LteExpr.
 */
class LteExpr extends AbstractExpr
{
    /**
     * LteExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct($relation, $column, $value);

        $this->setExpression('$lte');
        $this->setOperator('<=');
    }
}
