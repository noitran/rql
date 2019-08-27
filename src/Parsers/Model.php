<?php

declare(strict_types=1);

namespace Noitran\RQL\Parsers;

/**
 * Class Model.
 */
class Model
{
    /**
     * @var string
     */
    protected $relation;

    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $expression;

    /**
     * @var string
     */
    protected $dataType;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return string
     */
    public function getRelation(): ?string
    {
        return $this->relation;
    }

    /**
     * @param string $relation
     *
     * @return Model
     */
    public function setRelation(?string $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     *
     * @return Model
     */
    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     *
     * @return Model
     */
    public function setExpression(string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataType(): string
    {
        return $this->dataType;
    }

    /**
     * @param string $dataType
     *
     * @return Model
     */
    public function setDataType(string $dataType): self
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return Model
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }
}
