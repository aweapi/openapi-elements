<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class SecurityRequirementCollectionBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForSecurityRequirements(): void
    {
        $factory = $this->getBuilderFactory();
        $collection = $factory->securityRequirementCollection()
            ->addSecurityRequirements(
                $factory->securityRequirement()
                    ->setItem('petstore_auth', ['write:pets', 'read:pets'])
            )
            ->createSecurityRequirementCollection()
        ;
        self::assertJsonObject([
            [
                'petstore_auth' => ['write:pets', 'read:pets'],
            ],
        ], $collection);
    }
}
