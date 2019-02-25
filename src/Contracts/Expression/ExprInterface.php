<?php

namespace Noitran\RQL\Contracts\Expression;

use Noitran\RQL\Expressions\AbstractExpr;

/**
 * Interface ExprInterface
 */
interface ExprInterface
{
    /**
     * @return string|null
     */
    public function getRelation(): ?string;

    /**
     * @return string
     */
    public function getColumn(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param string|null $expression
     *
     * @return AbstractExpr
     */
    public function setExpression(string $expression = null): AbstractExpr;

    /**
     * @return string
     */
    public function getExpression(): string;

    /**
     * @param string|null $operator
     *
     * @return AbstractExpr
     */
    public function setOperator(string $operator = null): AbstractExpr;

    /**
     * @return string
     */
    public function getOperator(): string;
}
