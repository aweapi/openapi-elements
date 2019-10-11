<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class ParameterCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForNonServers(): void
    {
        $item = $this->createAbstractDefinition(null);
        $this->expectException(TypeError::class);
        $this->createParameterCollection([$item]);
    }

    /**
     * @test
     */
    public function isCreatedForServers(): void
    {
        $item = $this->createParameter('id', 'path');
        $collection = $this->createParameterCollection([$item]);
        self::assertTrue($collection->hasItems());
        self::assertSame([$item], $collection->getItems());
        self::assertJsonObject([
            [
                'name' => 'id',
                'in' => 'path',
            ],
        ], $collection);
    }
}
