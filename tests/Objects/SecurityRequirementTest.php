<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class SecurityRequirementTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createSecurityRequirement([
            'petstore_auth' => ['write:pets', 'read:pets'],
        ]);
        self::assertJsonObject([
            'petstore_auth' => ['write:pets', 'read:pets'],
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createSecurityRequirement([]);
        self::assertNull($object->jsonSerialize());
    }
}
