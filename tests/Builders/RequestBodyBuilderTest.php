<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;
use stdClass;

final class RequestBodyBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedAsRequestBodyAggregate(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->requestBody()
            ->setContent(
                $factory->mediaTypes()
            )
            ->createRequestBodyAggregate()
        ;
        self::assertJsonObject([
            'content' => new stdClass(),
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->requestBody()
            ->setContent(
                $factory->mediaTypes()
            )
            ->setDescription('Description')
            ->setRequired(true)
            ->addExtensions(['x-foo' => null])
            ->createRequestBodyAggregate()
        ;
        self::assertJsonObject([
            'content' => new stdClass(),
            'description' => 'Description',
            'required' => true,
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->requestBody()
            ->setContent(
                $factory->mediaTypes()
            )
            ->createRequestBody()
        ;
        self::assertJsonObject([
            'content' => new stdClass(),
        ], $object);
    }
}
