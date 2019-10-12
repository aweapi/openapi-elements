<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class PathTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $summary = 'Summary';
        $description = 'Description';
        $href = '#/components/schemas/PetEndpoint';
        $getOperation = $this->createOperation(
            $this->createOperationResponses([], $this->createResponse('Get pet'))
        );
        $optionsOperation = $this->createOperation(
            $this->createOperationResponses([], $this->createResponse('Endpoint options'))
        );
        $serverUrl = 'https://example.com';
        $object = $this->createPath(
            $summary,
            $this->createReference($href),
            $description,
            $getOperation,
            null,
            null,
            null,
            null,
            $optionsOperation,
            null,
            null,
            $this->createServerCollection([$this->createServer($serverUrl)]),
            $this->createParameterCollection([$this->createParameter('id', 'path')]),
            $this->createExtensions(['x-foo' => null])
        );
        self::assertTrue($object->hasOperation('GET'));
        self::assertSame($getOperation, $object->getOperation('GET'));
        self::assertJsonObject([
            '$ref' => $href,
            'summary' => $summary,
            'description' => $description,
            'servers' => [
                [
                    'url' => $serverUrl,
                ],
            ],
            'parameters' => [
                [
                    'name' => 'id',
                    'in' => 'path',
                ],
            ],
            'get' => [
                'responses' => [
                    'default' => [
                        'description' => 'Get pet',
                    ],
                ],
            ],
            'options' => [
                'responses' => [
                    'default' => [
                        'description' => 'Endpoint options',
                    ],
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
        $object = $this->createPath();
        self::assertNull($object->jsonSerialize());
    }
}
