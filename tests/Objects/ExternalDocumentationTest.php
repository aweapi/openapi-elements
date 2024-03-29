<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class ExternalDocumentationTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createExternalDocumentation(
            'https://example.com/docs',
            'Description',
            $this->createExtensions(['x-foo' => null])
        );
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
        $object = $this->createExternalDocumentation(
            'https://example.com/docs'
        );
        self::assertJsonObject([
            'url' => 'https://example.com/docs',
        ], $object);
    }
}
