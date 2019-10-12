<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class ParameterTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithContent(): void
    {
        $object = $this->createParameter(
            'id',
            'path',
            null,
            $this->createMediaTypes([
                'json' => $this->createMediaType($this->createReference('#/components/parameters/Id')),
            ])
        );
        self::assertJsonObject([
            'name' => 'id',
            'in' => 'path',
            'content' => [
                'json' => [
                    'schema' => [
                        '$ref' => '#/components/parameters/Id',
                    ],
                ],
            ],
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createParameter(
            'id',
            'path',
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
            'name' => 'id',
            'in' => 'path',
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
        $object = $this->createParameter(
            'id',
            'path'
        );
        self::assertJsonObject([
            'name' => 'id',
            'in' => 'path',
        ], $object);
    }
}
