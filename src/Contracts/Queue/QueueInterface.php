<?php

declare(strict_types=1);

namespace Noitran\RQL\Contracts\Queue;

use Noitran\RQL\Exceptions\ExpressionException;
use Noitran\RQL\Expressions\AbstractExpr;
use Noitran\RQL\Queues\ExprQueue;

/**
 * Interface QueueInterface.
 */
interface QueueInterface
{
    /**
     * Enqueue a ExprInterface.
     *
     * @param AbstractExpr $exprClass
     *
     * @throws ExpressionException
     *
     * @return ExprQueue
     */
    public function enqueue($exprClass): ExprQueue;
}
