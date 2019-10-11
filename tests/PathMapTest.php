<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class PathMapTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedEmpty(): void
    {
        $object = $this->createPathMap([]);
        self::assertNull($object->jsonSerialize());
    }

    /**
     * @test
     */
    public function isCreatedWithExtensions(): void
    {
        $path = $this->createPath('Pets API');
        $paths = [
            '/pets/{petId}' => $path,
        ];
        $object = $this->createPathMap($paths, $this->createExtensionMap([
            'x-foo' => 'bar',
        ]));
        self::assertSame($paths, $object->getPaths());
        self::assertTrue($object->hasPath('/pets/{petId}'));
        self::assertFalse($object->hasPath('/pets'));
        self::assertSame($path, $object->getPath('/pets/{petId}'));
        self::assertJsonObject(
            [
                '/pets/{petId}' => [
                    'summary' => 'Pets API',
                ],
                'x-foo' => 'bar',
            ],
            $object
        );
    }
}
