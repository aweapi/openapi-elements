<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class ServerCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForNonServers(): void
    {
        $item = $this->createAbstractDefinition(null);
        $this->expectException(TypeError::class);
        $this->createServerCollection([$item]);
    }

    /**
     * @test
     */
    public function isCreatedForServers(): void
    {
        $item = $this->createServer('/');
        $collection = $this->createServerCollection([$item]);
        self::assertTrue($collection->hasItems());
        self::assertSame([$item], $collection->getItems());
        self::assertJsonObject([
            ['url' => '/'],
        ], $collection);
    }
}
