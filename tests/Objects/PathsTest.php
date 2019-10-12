<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class PathsTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedEmpty(): void
    {
        $object = $this->createPaths([]);
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
        $object = $this->createPaths($paths, $this->createExtensions([
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
