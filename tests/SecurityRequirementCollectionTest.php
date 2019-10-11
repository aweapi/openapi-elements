<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use TypeError;

final class SecurityRequirementCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreateForNonServers(): void
    {
        $item = $this->createAbstractDefinition(null);
        $this->expectException(TypeError::class);
        $this->createSecurityRequirementCollection([$item]);
    }

    /**
     * @test
     */
    public function isCreatedForServers(): void
    {
        $item = $this->createSecurityRequirement([
            'petstore_auth' => ['write:pets', 'read:pets'],
        ]);
        $collection = $this->createSecurityRequirementCollection([$item]);
        self::assertTrue($collection->hasItems());
        self::assertSame([$item], $collection->getItems());
        self::assertJsonObject([
            [
                'petstore_auth' => ['write:pets', 'read:pets'],
            ],
        ], $collection);
    }
}
