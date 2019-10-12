<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class OperationResponsesTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createOperationResponses(
            [
                200 => $this->createResponse('OK'),
                '201' => $this->createResponse('Created'),
                '4xx' => $this->createResponse('Client error'),
                '5xx' => $this->createResponse('Server error'),
            ],
            $this->createResponse('Default response'),
            $this->createExtensions(['x-foo' => null])
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
        $object = $this->createOperationResponses([]);
        self::assertNull($object->jsonSerialize());
    }
}
