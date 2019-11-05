<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class PathsBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedEmpty(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->paths()
            ->createPaths()
        ;
        self::assertNull($object->jsonSerialize());
    }

    /**
     * @test
     */
    public function isCreatedForPaths(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->paths()
            ->addPaths([
                '/pets/{petId}' => $factory->path()
                    ->setSummary('Pets API'),
            ])
            ->addExtensions(['x-foo' => null])
            ->createPaths()
        ;
        self::assertJsonObject([
            '/pets/{petId}' => [
                'summary' => 'Pets API',
            ],
            'x-foo' => null,
        ], $object);
    }
}
