<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ExternalDocumentationBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->externalDocs()
            ->setUrl('https://example.com/docs')
            ->setDescription('Description')
            ->addExtensions(['x-foo' => null])
            ->createExternalDocumentation()
        ;
        self::assertJsonObject([
            'url' => 'https://example.com/docs',
            'description' => 'Description',
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->externalDocs()
            ->setUrl('https://example.com/docs')
            ->createExternalDocumentation()
        ;
        self::assertJsonObject([
            'url' => 'https://example.com/docs',
        ], $object);
    }
}
