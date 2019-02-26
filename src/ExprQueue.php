<?php

namespace Noitran\RQL;

use Noitran\RQL\Expressions\AbstractExpr;
use SplQueue;
use Noitran\RQL\Contracts\Expression\ExprInterface;
use Noitran\RQL\Contracts\Queue\QueueInterface;
use Noitran\RQL\Exceptions\ExpressionException;

class ExprQueue extends SplQueue implements QueueInterface
{
    /**
     * @param AbstractExpr $exprClass
     *
     * @throws ExpressionException
     *
     * @return ExprQueue
     */
    public function enqueue($exprClass): ExprQueue
    {
        if (! $exprClass instanceof ExprInterface) {
            throw new ExpressionException(sprintf(
                'The $exprClass variable is not an instance of %s.',
                ExprInterface::class
            ));
        }

        parent::enqueue($exprClass);

        return $this;
    }
}
