<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class DiscriminatorBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->discriminator()
            ->setPropertyName('petType')
            ->setMapping([
                'dog' => '#/components/schemas/Dog',
                'cat' => 'https://example/schema.json',
            ])
            ->createDiscriminator()
        ;
        self::assertJsonObject([
            'propertyName' => 'petType',
            'mapping' => [
                'dog' => '#/components/schemas/Dog',
                'cat' => 'https://example/schema.json',
            ],
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->discriminator()
            ->setPropertyName('petType')
            ->createDiscriminator()
        ;
        self::assertJsonObject([
            'propertyName' => 'petType',
        ], $object);
    }
}
