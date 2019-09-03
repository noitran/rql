<?php

declare(strict_types=1);

namespace Noitran\RQL\Tests\Parsers\Request\Illuminate;

use Noitran\RQL\Parsers\Simple\SimpleParser;
use Noitran\RQL\Tests\TestCase;

class SimpleParserTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_parse_request(): void
    {
        $request = [
            'filter' => [
                'name' => 'John',
                'surname' => 'Doe',
            ],
        ];

        $collection = (new SimpleParser($request))->parse();
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
        $request = [
            'filter' => [
                'profile.name' => 'John',
                'profile.surname' => 'Doe',
            ],
        ];

        $collection = (new SimpleParser($request))->parse();
        $array = $collection->toArray();

        $this->assertEquals('profile', $array[0]->getRelation());
        $this->assertEquals('name', $array[0]->getField());

        $this->assertEquals('profile', $array[1]->getRelation());
        $this->assertEquals('surname', $array[1]->getField());
    }
}
