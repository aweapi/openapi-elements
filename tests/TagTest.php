<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class TagTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createTag(
            'Pets',
            'Description',
            $this->createExternalDocumentation('https://example.com/docs'),
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'name' => 'Pets',
            'description' => 'Description',
            'externalDocs' => [
                'url' => 'https://example.com/docs',
            ],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createTag(
            'Pets'
        );
        self::assertJsonObject([
            'name' => 'Pets',
        ], $object);
    }
}
