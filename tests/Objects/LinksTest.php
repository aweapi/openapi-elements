<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;
use TypeError;

final class LinksTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForInvalidItemName(): void
    {
        $item = $this->createLink('readPet');
        $items = [0 => $item];
        $this->expectException(TypeError::class);
        $this->createLinks($items);
    }

    /**
     * @test
     */
    public function failsOnCreateForNonLinks(): void
    {
        $item = $this->createAbstractDefinition(['x-foo' => 'foo']);
        $items = ['ExampleLink' => $item];
        $this->expectException(TypeError::class);
        $this->createLinks($items);
    }

    /**
     * @test
     */
    public function isCreatedForLinks(): void
    {
        $item = $this->createLink('readPet');
        $items = ['ExampleLink' => $item];
        $collection = $this->createLinks($items);
        self::assertTrue($collection->hasItems());
        self::assertSame($items, $collection->getItems());
        self::assertJsonObject([
            'ExampleLink' => [
                'operationId' => 'readPet',
            ],
        ], $collection);
    }
}
