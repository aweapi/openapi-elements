<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use InvalidArgumentException;

final class LinkTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnCreatedWithMutuallyExclusiveOperationReference(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('The Link operationId and operationRef are mutually exclusive'));
        $this->createLink(
            'readPet',
            '#/components/responses/get'
        );
    }

    /**
     * @test
     */
    public function failsOnCreatedWithoutMandatoryOperation(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('The Link must have either operationId or operationRef'));
        $this->createLink();
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createLink(
            'readPet',
            null,
            'Description',
            ['parameter'],
            'request body',
            $this->createServer('https://example.com'),
            $this->createExtensionMap(['x-foo' => null])
        );
        self::assertJsonObject([
            'operationId' => 'readPet',
            'description' => 'Description',
            'parameters' => ['parameter'],
            'requestBody' => 'request body',
            'server' => ['url' => 'https://example.com'],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createLink(null, '#/components/responses/get');
        self::assertJsonObject([
            'operationRef' => '#/components/responses/get',
        ], $object);
    }
}
