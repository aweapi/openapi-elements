<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;
use TypeError;

final class TagCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForNonServers(): void
    {
        $item = $this->createAbstractDefinition(null);
        $this->expectException(TypeError::class);
        $this->createTagCollection([$item]);
    }

    /**
     * @test
     */
    public function isCreatedForServers(): void
    {
        $item = $this->createTag('pets');
        $collection = $this->createTagCollection([$item]);
        self::assertTrue($collection->hasItems());
        self::assertSame([$item], $collection->getItems());
        self::assertJsonObject([
            ['name' => 'pets'],
        ], $collection);
    }
}
