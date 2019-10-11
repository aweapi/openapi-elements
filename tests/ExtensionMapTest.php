<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use ArrayIterator;

final class ExtensionMapTest extends TestCase
{
    /**
     * @test
     */
    public function acceptsAnyJsonValue(): void
    {
        $extensions = $this->createExtensionMap([
            'null' => null,
            'string' => 'foo',
            'integer' => 1,
            'double' => 1.2,
            'array' => ['foo', 'bar'],
            'object' => $this->createExtensionMap([]),
        ]);
        self::assertJsonObject([
            'null' => null,
            'string' => 'foo',
            'integer' => 1,
            'double' => 1.2,
            'array' => ['foo', 'bar'],
            'object' => $this->createExtensionMap([]),
        ], $extensions);
    }

    /**
     * @test
     */
    public function extendsValuesWithItsData(): void
    {
        $extensions = $this->createExtensionMap([]);
        self::assertSame([
            'foo' => 'bar',
        ], $extensions->extendValues(['foo' => 'bar']));

        $extensions = $this->createExtensionMap(['x-foo' => 'bar']);
        self::assertSame([
            'x-foo' => 'bar',
        ], $extensions->extendValues([]));

        $extensions = $this->createExtensionMap(['x-foo' => 'bar']);
        self::assertSame([
            'x-foo' => 'bar',
        ], $extensions->extendValues(null));

        $extensions = $this->createExtensionMap(['x-foo' => 'bar']);
        self::assertSame([
            'foo' => 'bar',
            'x-foo' => 'bar',
        ], $extensions->extendValues(['foo' => 'bar']));
    }

    /**
     * @test
     */
    public function isCountable(): void
    {
        $extensions = $this->createExtensionMap(['x-foo' => 'bar']);
        self::assertCount(1, $extensions);

        $extensions = $this->createExtensionMap([]);
        self::assertCount(0, $extensions);
    }

    /**
     * @test
     */
    public function isCreatedFromArray(): void
    {
        $extensions = $this->createExtensionMap([
            'x-foo' => 'bar',
        ]);
        self::assertTrue($extensions->hasExtension('x-foo'));
        self::assertFalse($extensions->hasExtension('x-bar'));
        self::assertSame('bar', $extensions->getExtension('x-foo'));
        self::assertJsonObject([
            'x-foo' => 'bar',
        ], $extensions);
    }

    /**
     * @test
     */
    public function isCreatedFromIterator(): void
    {
        $extensions = $this->createExtensionMap(new ArrayIterator([
            'x-foo' => 'bar',
        ]));
        self::assertJsonObject([
            'x-foo' => 'bar',
        ], $extensions);
    }
}
