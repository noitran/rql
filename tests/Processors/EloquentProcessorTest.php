<?php

namespace Noitran\RQL\Tests\Processors;

use Illuminate\Database\Eloquent\Builder;
use Noitran\RQL\Contracts\Processor\ProcessorInterface;
use Noitran\RQL\Expressions\AbstractExpr;
use Noitran\RQL\Processors\Eloquent\EloquentProcessor;
use Noitran\RQL\Queues\ExprQueue;
use Noitran\RQL\Tests\Stubs\Models\User;
use Noitran\RQL\Tests\TestCase;

/**
 * Class EloquentProcessorTest
 */
class EloquentProcessorTest extends TestCase
{
    /**
     * @var ExprQueue
     */
    protected $queue;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var EloquentProcessor
     */
    protected $processor;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->queue = new ExprQueue();
        $this->builder = User::query();
        $this->processor = $this->app->make(ProcessorInterface::class)->setBuilder($this->builder);
    }

    public function tearDown(): void
    {
        $this->builder = null;
        $this->queue = null;
    }

    /**
     * @param $expression
     * @param $column
     * @param $value
     *
     * @return AbstractExpr
     */
    protected function createExprClass($expression, $column, $value): AbstractExpr
    {
        $namespace = 'Noitran\RQL\Expressions\\';
        $exprClass = $namespace . $expression . 'Expr';

        return new $exprClass(null, $column, $value);
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestUsingRQLHelperFunction(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('between', 'id', '2,5')
        );

        $query = rql()->getProcessor()
            ->setBuilder($this->builder)
            ->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "id" between ? and ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprBetween(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('between', 'id', '2,5')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "id" between ? and ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprEq(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('eq', 'name', 'John')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "name" = ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprGte(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('gte', 'updated_at', '2019-01-01 14:00:23')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "updated_at" >= ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprGt(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('gt', 'updated_at', '2019-01-01 14:00:23')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "updated_at" > ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprIn(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('in', 'id', '2,5,6,227')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "id" in (?, ?, ?, ?)',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprLike(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('like', 'name', '%RandomName%')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "name" like ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprLte(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('lte', 'updated_at', '2019-01-01 14:00:23')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "updated_at" <= ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprLt(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('lt', 'updated_at', '2019-01-01 14:00:23')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "updated_at" < ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprNotEq(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('notEq', 'name', 'John')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "name" != ?',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprNotIn(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('notIn', 'id', '2,5,6,227')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where "id" not in (?, ?, ?, ?)',
            $query->toSql()
        );
    }

    /**
     * @test
     *
     * @throws \Noitran\RQL\Exceptions\ExpressionException
     */
    public function itShouldTestExprOr(): void
    {
        $exprClasses = $this->queue->enqueue(
            $this->createExprClass('or', 'id', '2|5|6')
        );

        /** @var EloquentProcessor $processor */
        $query = $this->processor->process($exprClasses);

        $this->assertEquals(
            'select * from "users" where ("id" = ? or "id" = ? or "id" = ?)',
            $query->toSql()
        );
    }
}
