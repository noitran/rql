<?php

namespace Noitran\RQL\Contracts\Queue;

use Noitran\RQL\Exceptions\ExpressionException;
use Noitran\RQL\Expressions\AbstractExpr;
use Noitran\RQL\ExprQueue;

/**
 * Interface QueueInterface
 */
interface QueueInterface
{
    /**
     * Enqueue a ExprInterface.
     *
     * @param AbstractExpr $exprClass
     *
     * @return ExprQueue
     * @throws ExpressionException
     */
    public function enqueue($exprClass): ExprQueue;
}
