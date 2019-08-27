<?php

declare(strict_types=1);

namespace Noitran\RQL\Contracts\Parser;

use Illuminate\Support\Collection;

/**
 * Interface ParserInterface.
 */
interface ParserInterface
{
    /**
     * @return Collection
     */
    public function parse(): Collection;
}
