<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class DiscriminatorTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createDiscriminator(
            'petType',
            [
                'dog' => '#/components/schemas/Dog',
                'cat' => 'https://example/schema.json',
            ]
        );
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
        $object = $this->createDiscriminator(
            'petType'
        );
        self::assertJsonObject([
            'propertyName' => 'petType',
        ], $object);
    }
}
