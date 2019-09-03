<?php

declare(strict_types=1);

namespace Noitran\RQL\Parsers\Simple;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Noitran\RQL\Parsers\AbstractParser;

/**
 * Class RequestParser.
 */
class SimpleParser extends AbstractParser
{
    /**
     * @var array
     */
    protected $request;

    /**
     * SimpleParser constructor.
     *
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;

        $this->init();
    }

    /**
     * @return string|array|null
     */
    public function getQueryValue()
    {
        return $this->request[$this->getQueryParameterName()];
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
