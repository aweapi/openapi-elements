<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi;

use ArrayIterator;

final class ExtensionsTest extends TestCase
{
    /**
     * @test
     */
    public function acceptsAnyJsonValue(): void
    {
        $extensions = $this->createExtensions([
            'null' => null,
            'string' => 'foo',
            'integer' => 1,
            'double' => 1.2,
            'array' => ['foo', 'bar'],
            'object' => $this->createExtensions([]),
        ]);
        self::assertJsonObject([
            'null' => null,
            'string' => 'foo',
            'integer' => 1,
            'double' => 1.2,
            'array' => ['foo', 'bar'],
            'object' => $this->createExtensions([]),
        ], $extensions);
    }

    /**
     * @test
     */
    public function extendsValuesWithItsData(): void
    {
        $extensions = $this->createExtensions([]);
        self::assertSame([
            'foo' => 'bar',
        ], $extensions->extendValues(['foo' => 'bar']));

        $extensions = $this->createExtensions(['x-foo' => 'bar']);
        self::assertSame([
            'x-foo' => 'bar',
        ], $extensions->extendValues([]));

        $extensions = $this->createExtensions(['x-foo' => 'bar']);
        self::assertSame([
            'x-foo' => 'bar',
        ], $extensions->extendValues(null));

        $extensions = $this->createExtensions(['x-foo' => 'bar']);
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
        $extensions = $this->createExtensions(['x-foo' => 'bar']);
        self::assertCount(1, $extensions);

        $extensions = $this->createExtensions([]);
        self::assertCount(0, $extensions);
    }

    /**
     * @test
     */
    public function isCreatedFromArray(): void
    {
        $extensions = $this->createExtensions([
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
        $extensions = $this->createExtensions(new ArrayIterator([
            'x-foo' => 'bar',
        ]));
        self::assertJsonObject([
            'x-foo' => 'bar',
        ], $extensions);
    }
}
