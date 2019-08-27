<?php

declare(strict_types=1);

namespace Noitran\RQL\Tests\Parsers\Request\Illuminate;

use Illuminate\Http\Request;
use Noitran\RQL\Parsers\Request\Illuminate\RequestParser;
use Noitran\RQL\Tests\TestCase;

/**
 * Class RequestParserTest.
 */
class RequestParserTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_parse_request(): void
    {
        $request = new Request();
        $request->replace([
            'filter' => [
                'name' => 'John',
                'surname' => 'Doe',
            ],
        ]);

        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertNull($array[0]->getRelation());
        $this->assertEquals('name', $array[0]->getField());

        $this->assertNull($array[1]->getRelation());
        $this->assertEquals('surname', $array[1]->getField());
    }

    /**
     * @test
     */
    public function it_should_get_relation_and_column_name(): void
    {
        $request = new Request();
        $request->replace([
            'filter' => [
                'profile.name' => 'John',
                'profile.surname' => 'Doe',
            ],
        ]);

        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('profile', $array[0]->getRelation());
        $this->assertEquals('name', $array[0]->getField());

        $this->assertEquals('profile', $array[1]->getRelation());
        $this->assertEquals('surname', $array[1]->getField());
    }

    /**
     * @test
     */
    public function it_should_get_logical_expression(): void
    {
        $request = new Request();
        $request->replace([
            'filter' => [
                'profile.name' => [
                    '$eq' => 'John'
                ],
                'profile.surname' => [
                    '$like' => '%Doe%',
                ]
            ],
        ]);

        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('$eq', $array[0]->getExpression());
        $this->assertEquals('$like', $array[1]->getExpression());
    }

    /**
     * @test
     */
    public function it_should_get_data_type_and_value(): void
    {
        $request = (new Request())->replace(['filter' => ['profile.name' => 'John']]);
        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('John', $array[0]->getValue());
        $this->assertEquals('$string', $array[0]->getDataType());

        // ------------------------------------------------------------

        $request = (new Request())->replace(['filter' => ['profile.name' => ['$eq' => 'John']]]);
        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('John', $array[0]->getValue());
        $this->assertEquals('$string', $array[0]->getDataType());

        // ------------------------------------------------------------

        $request = (new Request())->replace(['filter' => ['profile.name' => ['$eq' => '$string:John']]]);
        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('John', $array[0]->getValue());
        $this->assertEquals('$string', $array[0]->getDataType());

        // ------------------------------------------------------------

        $request = (new Request())->replace(['filter' => ['profile.name' => ['$eq' => '$int:123']]]);
        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('123', $array[0]->getValue());
        $this->assertEquals('$int', $array[0]->getDataType());

        // ------------------------------------------------------------

        $request = (new Request())->replace(['filter' => ['profile.name' => ['$eq' => '$unknown:John']]]);
        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('John', $array[0]->getValue());
        $this->assertEquals('$string', $array[0]->getDataType());

        // ------------------------------------------------------------

        $request = (new Request())->replace(
            ['filter' => ['profile.name' => ['$eq' => '$int:some_data:another_data:John']]]
        );
        $collection = (new RequestParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('some_data:another_data:John', $array[0]->getValue());
        $this->assertEquals('$int', $array[0]->getDataType());
    }
}
