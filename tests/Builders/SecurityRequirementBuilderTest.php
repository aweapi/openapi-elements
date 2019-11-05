<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class SecurityRequirementBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->securityRequirement()
            ->addItems([
                'petstore_auth' => ['write:pets', 'read:pets'],
            ])
            ->createSecurityRequirement()
        ;
        self::assertJsonObject([
            'petstore_auth' => ['write:pets', 'read:pets'],
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->securityRequirement()
            ->createSecurityRequirement()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
