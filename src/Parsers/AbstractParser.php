<?php

declare(strict_types=1);

namespace Noitran\RQL\Parsers;

use Noitran\RQL\Contracts\Parser\ParserInterface;

/**
 * Class AbstractParser.
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * @var mixed
     */
    protected $attributes;

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
