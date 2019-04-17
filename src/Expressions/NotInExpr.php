<?php

declare(strict_types=1);

namespace Noitran\RQL\Expressions;

/**
 * Class NotInExpr.
 */
class NotInExpr extends AbstractExpr
{
    /**
     * NotInExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        parent::__construct(
            $relation,
            $column,
            $this->valueToArray(',', $value)
        );

        $this->setExpression('$notIn');
        $this->setOperator();
    }
}
