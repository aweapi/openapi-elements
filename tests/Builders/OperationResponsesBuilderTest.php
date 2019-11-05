<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class OperationResponsesBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->operationResponses()
            ->setDefault(
                $factory->response()->setDescription('Default response')
            )
            ->addResponses([
                200 => $factory->response()->setDescription('OK'),
                '201' => $factory->response()->setDescription('Created'),
                '4xx' => $factory->response()->setDescription('Client error'),
                '5xx' => $factory->response()->setDescription('Server error'),
            ])
            ->addExtensions(['x-foo' => null])
            ->createOperationResponses()
        ;
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
        $factory = $this->getBuilderFactory();
        $object = $factory->operationResponses()
            ->createOperationResponses()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
