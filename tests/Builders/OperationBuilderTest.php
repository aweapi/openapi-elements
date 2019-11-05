<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class OperationBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();

        $summary = 'Summary';
        $description = 'Description';
        $tags = ['Pets'];
        $operationId = 'GetPet';
        $serverUrl = 'https://example.com';

        $object = $factory->operation()
            ->setResponses(
                $factory->operationResponses()
                    ->setResponse('200', $factory->response()->setDescription('OK'))
            )
            ->setRequestBody(
                $factory->requestBody()
                    ->setContent(
                        $factory->mediaTypes()
                            ->setMediaType(
                                'application/json',
                                $factory->mediaType()->setSchema(
                                    $factory->ref()->setHref('#/components/requestBodies/ExampleRequestBody')
                                )
                            )
                    )
            )
            ->setTags($tags)
            ->setOperationId($operationId)
            ->setSummary($summary)
            ->setDescription($description)
            ->setDeprecated(true)
            ->setParameters(
                $factory->parameterCollection()
                    ->addParameters(
                        $factory->parameter()
                            ->setName('id')
                            ->setIn('path')
                    )
            )
            ->setSecurity(
                $factory->securityRequirementCollection()
                    ->addSecurityRequirements(
                        $factory->securityRequirement()->setItem('petstore_auth', ['write:pets', 'read:pets'])
                    )
            )
            ->setServers(
                $factory->serverCollection()
                    ->addServers(
                        $factory->server()->setUrl($serverUrl)
                    )
            )
            ->setExternalDocs(
                $factory->externalDocs()->setUrl('https://example.com/docs')
            )
            ->addExtensions(['x-foo' => null])
            ->createOperation()
        ;
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
            // 'callbacks' => [
            //     'FooCallback' => [
            //         'https://example.com/?email={$request.body#/email}' => [
            //             '$ref' => '#/components/schemas/webhook-path-schema',
            //         ],
            //     ],
            // ],
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
        $factory = $this->getBuilderFactory();
        $object = $factory->operation()
            ->setResponses(
                $factory->operationResponses()
                    ->setResponse('200', $factory->response()->setDescription('OK'))
            )
            ->createOperation()
        ;
        self::assertJsonObject([
            'responses' => [
                '200' => [
                    'description' => 'OK',
                ],
            ],
        ], $object);
    }
}
