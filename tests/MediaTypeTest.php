<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class MediaTypeTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createMediaType(
            $this->createSchema(['type' => 'string']),
            $this->createExamples([
                'one' => $this->createReference('#/components/schemas/ExampleOne'),
                'two' => $this->createReference('#/components/schemas/ExampleTwo'),
            ]),
            $this->createEncodings([
                'variable' => $this->createEncoding('application/json'),
            ]),
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'schema' => ['type' => 'string'],
            'examples' => [
                'one' => [
                    '$ref' => '#/components/schemas/ExampleOne',
                ],
                'two' => [
                    '$ref' => '#/components/schemas/ExampleTwo',
                ],
            ],
            'encoding' => [
                'variable' => [
                    'contentType' => 'application/json',
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
        $object = $this->createMediaType();
        self::assertNull($object->jsonSerialize());
    }
}
