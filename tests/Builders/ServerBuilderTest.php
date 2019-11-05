<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ServerBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->server()
            ->setUrl('https://example.com')
            ->setDescription('Description')
            ->setVariables(
                $factory->serverVariables()
                    ->setVariable(
                        'id',
                        $factory->serverVariable()
                            ->setDefault(true)
                    )
            )
            ->addExtensions(['x-foo' => null])
            ->createServer()
        ;
        self::assertJsonObject([
            'url' => 'https://example.com',
            'description' => 'Description',
            'variables' => [
                'id' => ['default' => true],
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
        $object = $factory->server()
            ->setUrl('https://example.com')
            ->createServer()
        ;
        self::assertJsonObject([
            'url' => 'https://example.com',
        ], $object);
    }
}
