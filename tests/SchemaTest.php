<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class SchemaTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithExtensions(): void
    {
        $schema = $this->createSchema([
            'type' => 'string',
            'format' => 'email',
        ], $this->createExtensions([
            'x-foo' => 'bar',
        ]));
        self::assertJsonObject([
            'type' => 'string',
            'format' => 'email',
            'x-foo' => 'bar',
        ], $schema);
    }

    /**
     * @test
     */
    public function isCreateWithProperties(): void
    {
        $schema = $this->createSchema([
            'type' => 'string',
            'format' => 'email',
        ]);
        self::assertJsonObject([
            'type' => 'string',
            'format' => 'email',
        ], $schema);
    }

    /**
     * @test
     */
    public function skipsEmptyAttributes(): void
    {
        $schema = $this->createSchema([
            'type' => 'string',
            'format' => null,
        ]);
        self::assertJsonObject([
            'type' => 'string',
        ], $schema);
    }
}
