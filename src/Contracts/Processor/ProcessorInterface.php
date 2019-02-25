<?php

namespace Noitran\RQL\Contracts\Processor;

use Noitran\RQL\ExprQueue;

/**
 * Interface ProcessorInterface
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
