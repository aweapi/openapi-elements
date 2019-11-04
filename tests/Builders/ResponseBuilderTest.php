<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ResponseBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->response()
            ->setDescription('Description')
            ->setHeaders(
                $factory->headers()
                    ->setHeader(
                        'Content-Type',
                        $factory->header()
                            ->setSchema(
                                $factory->schema()
                                    ->setAttributes(['type' => 'string'])
                            )
                    )
            )
            ->setLinks(
                $factory->links()
                    ->setLink(
                        'self',
                        $factory->link()
                            ->setOperationId('ReadMe')
                    )
            )
            ->addExtensions(['x-foo' => null])
            ->createResponse()
        ;
        self::assertJsonObject([
            'description' => 'Description',
            'headers' => [
                'Content-Type' => [
                    'schema' => ['type' => 'string'],
                ],
            ],
            'links' => [
                'self' => [
                    'operationId' => 'ReadMe',
                ],
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
        $object = $factory->response()
            ->setDescription('Description')
            ->createResponse()
        ;
        self::assertJsonObject([
            'description' => 'Description',
        ], $object);
    }
}
