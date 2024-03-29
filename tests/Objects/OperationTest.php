<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;

final class OperationTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $responses = $this->createOperationResponses([
            '200' => $this->createResponse('OK'),
        ]);
        $requestBody = $this->createRequestBody(
            $this->createMediaTypes([
                'application/json' => $this->createMediaType(
                    $this->createReference('#/components/requestBodies/ExampleRequestBody')
                ),
            ])
        );
        $summary = 'Summary';
        $description = 'Description';
        $tags = ['Pets'];
        $operationId = 'GetPet';
        $serverUrl = 'https://example.com';
        $externalDocs = $this->createExternalDocumentation('https://example.com/docs');
        $callback = $this->createCallbackRequest(
            [
                'https://example.com/?email={$request.body#/email}' => $this->createPath(
                    null,
                    $this->createReference('#/components/schemas/webhook-path-schema')
                ),
            ]
        );

        $object = $this->createOperation(
            $responses,
            $requestBody,
            $tags,
            $operationId,
            $summary,
            $description,
            true,
            $this->createParameterCollection([$this->createParameter('id', 'path')]),
            $this->createSecurityRequirementCollection([
                $this->createSecurityRequirement([
                    'petstore_auth' => ['write:pets', 'read:pets'],
                ]),
            ]),
            $this->createCallbackRequests(['FooCallback' => $callback]),
            $this->createServerCollection([$this->createServer($serverUrl)]),
            $externalDocs,
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'responses' => [
                '200' => [
                    'description' => 'OK',
                ],
            ],
            'requestBody' => [
                'content' => [
                    'application/json' => [
                        'schema' => [
                            '$ref' => '#/components/requestBodies/ExampleRequestBody',
                        ],
                    ],
                ],
            ],
            'tags' => $tags,
            'operationId' => $operationId,
            'summary' => $summary,
            'description' => $description,
            'deprecated' => true,
            'parameters' => [
                [
                    'name' => 'id',
                    'in' => 'path',
                ],
            ],
            'security' => [
                [
                    'petstore_auth' => ['write:pets', 'read:pets'],
                ],
            ],
            'callbacks' => [
                'FooCallback' => [
                    'https://example.com/?email={$request.body#/email}' => [
                        '$ref' => '#/components/schemas/webhook-path-schema',
                    ],
                ],
            ],
            'servers' => [
                [
                    'url' => $serverUrl,
                ],
            ],
            'externalDocs' => [
                'url' => 'https://example.com/docs',
            ],
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $responses = $this->createOperationResponses([
            '200' => $this->createResponse('OK'),
        ]);
        $object = $this->createOperation(
            $responses,
            null,
            []
        );
        self::assertJsonObject([
            'responses' => [
                '200' => [
                    'description' => 'OK',
                ],
            ],
        ], $object);
    }
}
