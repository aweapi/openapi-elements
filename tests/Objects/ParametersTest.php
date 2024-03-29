<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;
use TypeError;

final class ParametersTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createParameter('id', 'path');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createParameters($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonParameter(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleResponse' => $item];
        $this->expectException(TypeError::class);
        $this->createParameters($items);
    }

    /**
     * @test
     */
    public function isCreatedForParameters(): void
    {
        $item = $this->createParameter('id', 'path');
        $items = ['ExampleParameter' => $item];
        $collection = $this->createParameters($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleParameter' => ['name' => 'id', 'in' => 'path'],
        ], $collection);
    }
}
