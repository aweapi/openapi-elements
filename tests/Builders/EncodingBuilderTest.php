<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class EncodingBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->encoding()
            ->setContentType('application/json')
            ->setHeaders(
                $factory->headers()
                    ->setHeader(
                        'Rate-Limiting',
                        $factory->header()
                            ->setSchema(
                                $factory->schema()
                                    ->setAttributes(['type' => 'integer'])
                            )
                    )
            )
            ->setStyle('form')
            ->setExplode(false)
            ->setAllowReserved(true)
            ->addExtensions(['x-foo' => null])
            ->createEncoding()
        ;
        self::assertJsonObject([
            'contentType' => 'application/json',
            'headers' => [
                'Rate-Limiting' => [
                    'schema' => ['type' => 'integer'],
                ],
            ],
            'style' => 'form',
            'explode' => false,
            'allowReserved' => true,
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->encoding()
            ->createEncoding()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
