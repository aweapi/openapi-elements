<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class TagBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->tag()
            ->setName('Pets')
            ->setDescription('Description')
            ->setExternalDocs(
                $factory->externalDocs()
                    ->setUrl('https://example.com/docs')
            )
            ->addExtensions(['x-foo' => null])
            ->createTag()
        ;
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
        $factory = $this->getBuilderFactory();
        $object = $factory->tag()
            ->setName('Pets')
            ->createTag()
        ;
        self::assertJsonObject([
            'name' => 'Pets',
        ], $object);
    }
}
