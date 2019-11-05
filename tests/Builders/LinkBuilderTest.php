<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class LinkBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->link()
            ->setOperationId('readPet')
            ->setDescription('Description')
            ->setParameters(['parameter'])
            ->setRequestBody('request body')
            ->setServer(
                $factory->server()
                    ->setUrl('https://example.com')
            )
            ->addExtensions(['x-foo' => null])
            ->createLink()
        ;
        self::assertJsonObject([
            'operationId' => 'readPet',
            'description' => 'Description',
            'parameters' => ['parameter'],
            'requestBody' => 'request body',
            'server' => ['url' => 'https://example.com'],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->link()
            ->setOperationRef('#/components/responses/get')
            ->createLink()
        ;
        self::assertJsonObject([
            'operationRef' => '#/components/responses/get',
        ], $object);
    }
}
