<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ReferenceBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedAsExampleAggregate(): void
    {
        $factory = $this->getBuilderFactory();
        $href = '#/components/schemas/Foo';
        $object = $factory->ref()
            ->setHref($href)
            ->createExampleAggregate()
        ;
        self::assertJsonObject([
            '$ref' => $href,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedAsHeaderAggregate(): void
    {
        $factory = $this->getBuilderFactory();
        $href = '#/components/schemas/Foo';
        $object = $factory->ref()
            ->setHref($href)
            ->createHeaderAggregate()
        ;
        self::assertJsonObject([
            '$ref' => $href,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedAsResponseAggregate(): void
    {
        $factory = $this->getBuilderFactory();
        $href = '#/components/schemas/Foo';
        $object = $factory->ref()
            ->setHref($href)
            ->createResponseAggregate()
        ;
        self::assertJsonObject([
            '$ref' => $href,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedAsSchemaAggregate(): void
    {
        $factory = $this->getBuilderFactory();
        $href = '#/components/schemas/Foo';
        $object = $factory->ref()
            ->setHref($href)
            ->createSchemaAggregate()
        ;
        self::assertJsonObject([
            '$ref' => $href,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $href = '#/components/schemas/Foo';
        $object = $factory->ref()
            ->setHref($href)
            ->createReference()
        ;
        self::assertJsonObject([
            '$ref' => $href,
        ], $object);
    }
}
