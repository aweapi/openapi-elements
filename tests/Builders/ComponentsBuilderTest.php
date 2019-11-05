<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ComponentsBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedEmpty(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->components()->createComponents();
        self::assertNull($object->jsonSerialize());
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->components()
            ->setSchemas(
                $factory->schemas()
                    ->addSchemas([
                        'DemoSchema' => $factory->schema()
                            ->setAttributes(['type' => 'string']),
                    ])
            )
            ->setResponses(
                $factory->responses()
                    ->addResponses([
                        'DemoResponse' => $factory->ref()
                            ->setHref('https://example.com/schema.json#/responses/DemoResponse'),
                    ])
            )
            ->setParameters(
                $factory->parameters()
                    ->addParameters([
                        'DemoParameter' => $factory->ref()
                            ->setHref('https://example.com/schema.json#/parameters/DemoParameter'),
                    ])
            )
            ->setRequestBodies(
                $factory->requestBodies()
                    ->addRequestBodies([
                        'DemoRequest' => $factory->ref()
                            ->setHref('https://example.com/schema.json#/requestBodies/DemoRequest'),
                    ])
            )
            ->setHeaders(
                $factory->headers()
                    ->addHeaders([
                        'DemoHeader' => $factory->ref()
                            ->setHref('https://example.com/schema.json#/headers/DemoHeader'),
                    ])
            )
            ->setLinks(
                $factory->links()
                    ->addLinks([
                        'FooLink' => $factory->link()
                            ->setOperationId('readPet'),
                    ])
            )
            ->setCallbacks(
                $factory->callbackRequests()
                    ->addCallbacks([
                        'FooCallback' => $factory->callbackRequest()
                            ->addItems([
                                'https://example.com/?email={$request.body#/email}' => $factory->path()
                                    ->setReference($factory->ref()->setHref('#/components/schemas/webhook-path-schema')),
                            ]),
                    ])
            )
            ->setExamples(
                $factory->examples()
                    ->addExamples([
                        'FooExample' => $factory->ref()
                            ->setHref('https://example.com/schema.json#/examples/FooExample'),
                    ])
            )
            ->addExtensions(['x-foo' => null])
            ->createComponents()
        ;
        self::assertJsonObject([
            'schemas' => [
                'DemoSchema' => ['type' => 'string'],
            ],
            'responses' => [
                'DemoResponse' => [
                    '$ref' => 'https://example.com/schema.json#/responses/DemoResponse',
                ],
            ],
            'parameters' => [
                'DemoParameter' => [
                    '$ref' => 'https://example.com/schema.json#/parameters/DemoParameter',
                ],
            ],
            'requestBodies' => [
                'DemoRequest' => [
                    '$ref' => 'https://example.com/schema.json#/requestBodies/DemoRequest',
                ],
            ],
            'headers' => [
                'DemoHeader' => [
                    '$ref' => 'https://example.com/schema.json#/headers/DemoHeader',
                ],
            ],
            // 'securitySchemes' => [
            //     'SecurityScheme' => [
            //         '$ref' => 'https://example.com/schema.json#/securitySchemes/SecurityScheme',
            //     ],
            // ],
            'links' => [
                'FooLink' => [
                    'operationId' => 'readPet',
                ],
            ],
            'callbacks' => [
                'FooCallback' => [
                    'https://example.com/?email={$request.body#/email}' => [
                        '$ref' => '#/components/schemas/webhook-path-schema',
                    ],
                ],
            ],
            'examples' => [
                'FooExample' => [
                    '$ref' => 'https://example.com/schema.json#/examples/FooExample',
                ],
            ],
            'x-foo' => null,
        ], $object);
    }
}
