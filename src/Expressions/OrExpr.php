<?php

declare(strict_types=1);

namespace Noitran\RQL\Expressions;

use Noitran\RQL\Exceptions\ExpressionException;

/**
 * Class OrExpr.
 */
class OrExpr extends AbstractExpr
{
    /**
     * OrExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param $value
     *
     * @throws ExpressionException
     */
    public function __construct(?string $relation, string $column, $value)
    {
        if (\is_string($value)) {
            $value = array_filter(
                $this->valueToArray('|', trim($value))
            );
        }

        if (\count($value) < 2) {
            throw new ExpressionException('The number of "values" must be greater than one');
        }

        parent::__construct(
            $relation,
            $column,
            $value
        );

        $this->setExpression('$or');
        $this->setOperator();
    }
}
