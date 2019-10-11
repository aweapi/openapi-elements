<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class OperationResponseMapTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createOperationResponseMap(
            [
                200 => $this->createResponse('OK'),
                '201' => $this->createResponse('Created'),
                '4xx' => $this->createResponse('Client error'),
                '5xx' => $this->createResponse('Server error'),
            ],
            $this->createResponse('Default response'),
            $this->createExtensionMap(['x-foo' => null])
        );
        self::assertJsonObject([
            '200' => [
                'description' => 'OK',
            ],
            '201' => [
                'description' => 'Created',
            ],
            '4xx' => [
                'description' => 'Client error',
            ],
            '5xx' => [
                'description' => 'Server error',
            ],
            'default' => [
                'description' => 'Default response',
            ],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createOperationResponseMap([]);
        self::assertNull($object->jsonSerialize());
    }
}
