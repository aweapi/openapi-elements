<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class HeaderBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedAsSchemaAggregate(): void
    {
        $factory = $this->getBuilderFactory();
        $schema = $factory->header()
            ->setDescription('Description')
            ->createHeaderAggregate()
        ;
        self::assertJsonObject([
            'description' => 'Description',
        ], $schema);
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->header()
            ->setSchema(
                $factory->schema()
                    ->setAttributes(['type' => 'string'])
            )
            ->setDescription('Description')
            ->setRequired(true)
            ->setDeprecated(true)
            ->setAllowEmptyValue(true)
            ->setStyle('simple')
            ->setExplode(true)
            ->setAllowReserved(true)
            ->setExamples(
                $factory->examples()
                    ->setExample('one', $factory->ref()->setHref('#/components/schemas/ExampleOne'))
                    ->setExample('two', $factory->ref()->setHref('#/components/schemas/ExampleTwo'))
            )
            ->addExtensions(['x-foo' => null])
            ->createHeader()
        ;
        self::assertJsonObject([
            'schema' => ['type' => 'string'],
            'description' => 'Description',
            'required' => true,
            'deprecated' => true,
            'allowEmptyValue' => true,
            'style' => 'simple',
            'explode' => true,
            'allowReserved' => true,
            'examples' => [
                'one' => [
                    '$ref' => '#/components/schemas/ExampleOne',
                ],
                'two' => [
                    '$ref' => '#/components/schemas/ExampleTwo',
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
        $object = $factory->header()
            ->createHeader()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
