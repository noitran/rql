<?php

namespace Noitran\RQL\Expressions;

use Noitran\RQL\Contracts\Expression\ExprInterface;

/**
 * Class AbstractExpr
 */
abstract class AbstractExpr implements ExprInterface
{
    /**
     * @var string|null
     */
    protected $relation;

    /**
     * @var string
     */
    protected $column;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $expression;

    /**
     * @var string
     */
    protected $operator;

    /**
     * AbstractExpr constructor.
     *
     * @param string|null $relation
     * @param string $column
     * @param mixed $value
     */
    public function __construct(?string $relation, string $column, $value)
    {
        $this->relation = $relation;
        $this->column = $column;
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function getRelation(): ?string
    {
        return $this->relation;
    }

    /**
     * @inheritdoc
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function setExpression(string $expression = null): self
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @inheritdoc
     */
    public function setOperator(string $operator = null): self
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOperator(): string
    {
        return $this->operator;
    }
}
