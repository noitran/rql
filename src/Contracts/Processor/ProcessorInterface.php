<?php

declare(strict_types=1);

namespace Noitran\RQL\Contracts\Processor;

use Noitran\RQL\Queues\ExprQueue;

/**
 * Interface ProcessorInterface.
 */
interface ProcessorInterface
{
    /**
     * @param ExprQueue $exprClasses
     *
     * @return mixed
     */
    public function process(ExprQueue $exprClasses);
}
