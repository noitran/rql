<?php

declare(strict_types=1);

namespace Noitran\RQL\Parsers\Request\Illuminate;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Noitran\RQL\Exceptions\RuntimeException;
use Noitran\RQL\Parsers\AbstractParser;
use Noitran\RQL\Parsers\Model;

/**
 * Class RequestParser.
 */
class RequestParser extends AbstractParser
{
    /**
     * @var string
     */
    protected $queryParameterName;

    /**
     * @var Request
     */
    protected $request;

    /**
     * RequestParser constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->init();
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
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->request->toArray();
    }

    /**
     * @return RequestParser
     */
    public function setQueryParameterName(): self
    {
        $this->queryParameterName = config('rql.parsers.default_query_parameter', 'filter');

        return $this;
    }

    /**
     * @return string|array|null
     */
    public function getQueryParameter()
    {
        return $this->request->input($this->queryParameterName);
    }

    /**
     * @return mixed
     */
    public function parse(): Model
    {
        $model = new Model();

        $model->setRelation($this->parseRelation($this->filterParameter));
        $model->setField($this->parseColumn($this->filterParameter));
        $model->setExpression($this->parseExpression($this->filterValue));
        $model->setDataType($this->parseDataType($this->filterValue));
        $model->setValue($this->parseValue($this->filterValue));

        return $model;
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
            return config('repositories.filtering.default_expression', '$eq');
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
                return config('repositories.filtering.default_data_type', '$string');
            }

            return $parsedDataType;
        }

        return config('repositories.filtering.default_data_type', '$string');
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
        if (! \in_array($dataType, config('repositories.filtering.allowed_data_types', '$string'), true)) {
            if ($strict) {
                throw new RuntimeException('Invalid/Unallowed data type passed.');
            }

            return false;
        }

        return true;
    }
}
