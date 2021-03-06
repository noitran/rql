<?php

declare(strict_types=1);

namespace Noitran\RQL\Parsers\Request\Illuminate;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Noitran\RQL\Parsers\AbstractParser;

/**
 * Class RequestParser.
 */
class RequestParser extends AbstractParser
{
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
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->request->toArray();
    }

    /**
     * @return string|array|null
     */
    public function getQueryValue()
    {
        return $this->request->input($this->getQueryParameterName());
    }

    /**
     * @return Collection
     */
    public function parse(): Collection
    {
        $input = $this->getQueryValue();

        return $this->parseInput($input);
    }
}
