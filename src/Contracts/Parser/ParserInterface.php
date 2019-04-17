<?php

declare(strict_types=1);

namespace Noitran\RQL\Contracts\Parser;

use Noitran\RQL\Parsers\Model;

/**
 * Interface ParserInterface.
 */
interface ParserInterface
{
    /**
     * @return mixed
     */
    public function parse(): Model;
}
