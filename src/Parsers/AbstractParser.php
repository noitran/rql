<?php

declare(strict_types=1);

namespace Noitran\RQL\Parsers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Noitran\RQL\Contracts\Parser\ParserInterface;
use Noitran\RQL\Exceptions\RuntimeException;
use Noitran\RQL\Parsers\Request\Illuminate\RequestParser;

/**
 * Class AbstractParser.
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * @var string
     */
    protected $queryParameterName;

    /**
     * @var mixed
     */
    protected $attributes;

    /**
     * @return AbstractParser
     */
    public function setQueryParameterName(): self
    {
        $this->queryParameterName = config('rql.parsers.default_query_parameter', 'filter');

        return $this;
    }

    /**
     * @return string
     */
    public function getQueryParameterName(): string
    {
        return $this->queryParameterName;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return RequestParser
     */
    public function init(): self
    {
        $this->setQueryParameterName();

        return $this;
    }

    /**
     * @param $input
     *
     * @return Collection
     */
    protected function parseInput($input): Collection
    {
        $output = collect();

        foreach ($input as $key => $item) {
            $model = new Model();

            $model->setRelation($this->parseRelation($key))
                ->setField($this->parseColumn($key))
                ->setExpression($this->parseExpression($item))
                ->setDataType($this->parseDataType($item))
                ->setValue($this->parseValue($item))
            ;

            $output->push($model);
        }

        return $output;
    }

    /**
     * @param $filterParameter
     *
     * @return string|null
     */
    protected function parseRelation($filterParameter): ?string
    {
        if (false !== strpos($filterParameter, '.')) {
            $lastDotPosition = strrpos($filterParameter, '.');

            return substr($filterParameter, 0, $lastDotPosition);
        }

        return null;
    }

    /**
     * @param $filterParameter
     *
     * @return string
     */
    protected function parseColumn($filterParameter): string
    {
        if (false !== strpos($filterParameter, '.')) {
            $lastDotPosition = strrpos($filterParameter, '.');

            return substr($filterParameter, $lastDotPosition + 1);
        }

        return $filterParameter;
    }

    /**
     * @param $filterValue
     *
     * @return string
     */
    protected function parseExpression($filterValue): string
    {
        if (! \is_array($filterValue)) {
            return config('rql.filtering.default_expression', '$eq');
        }

        return key($filterValue);
    }

    /**
     * @param $filterValue
     *
     * @throws RuntimeException
     *
     * @return string
     */
    protected function parseDataType($filterValue): string
    {
        $value = $this->extractValue($filterValue);

        if (false !== strpos($value, ':')) {
            $lastColonPosition = strpos($value, ':');

            $parsedDataType = substr($value, 0, $lastColonPosition);

            if (! $this->isValidDataType($parsedDataType)) {
                return config('rql.filtering.default_data_type', '$string');
            }

            return $parsedDataType;
        }

        return config('rql.filtering.default_data_type', '$string');
    }

    /**
     * @param $filterValue
     *
     * @return string
     */
    protected function parseValue($filterValue): string
    {
        $value = $this->extractValue($filterValue);

        if (Str::startsWith($value, ['$']) && false !== strpos($value, ':')) {
            $lastColonPosition = strpos($value, ':');

            return substr($value, $lastColonPosition + 1);
        }

        return $value;
    }

    /**
     * @param $filterValue
     *
     * @return string
     */
    private function extractValue($filterValue): string
    {
        if (! \is_array($filterValue)) {
            return $filterValue;
        }

        return array_shift($filterValue);
    }

    /**
     * @param $dataType
     * @param bool $strict
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    private function isValidDataType($dataType, $strict = false): bool
    {
        if (! \in_array($dataType, config('rql.filtering.allowed_data_types', ['$string']), true)) {
            if ($strict) {
                throw new RuntimeException('Invalid/Not allowed data type passed.');
            }

            return false;
        }

        return true;
    }
}
