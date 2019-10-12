<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class HeaderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createHeader(
            $this->createSchema(['type' => 'string']),
            null,
            'Description',
            true,
            true,
            true,
            'simple',
            true,
            true,
            $this->createExamples([
                'one' => $this->createReference('#/components/schemas/ExampleOne'),
                'two' => $this->createReference('#/components/schemas/ExampleTwo'),
            ]),
            $this->createExtensions(['x-foo' => null])
        );
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
        $object = $this->createHeader();
        self::assertNull($object->jsonSerialize());
    }
}
