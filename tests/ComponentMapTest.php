<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

final class ComponentMapTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedEmpty(): void
    {
        $object = $this->createComponentMap();
        self::assertNull($object->jsonSerialize());
    }

    /**
     * @test
     */
    public function isCreatedWithExtensions(): void
    {
        $schema = $this->createSchema(['type' => 'string']);
        $schemas = $this->createSchemaMap(['DemoSchema' => $schema]);

        $response = $this->createReference('https://example.com/schema.json#/responses/DemoResponse');
        $responses = $this->createResponseMap(['DemoResponse' => $response]);

        $parameter = $this->createReference('https://example.com/schema.json#/parameters/DemoParameter');
        $parameters = $this->createParameterMap(['DemoParameter' => $parameter]);

        $requestBody = $this->createReference('https://example.com/schema.json#/requestBodies/DemoRequest');
        $requestBodies = $this->createRequestBodyMap(['DemoRequest' => $requestBody]);

        $header = $this->createReference('https://example.com/schema.json#/headers/DemoHeader');
        $headers = $this->createHeaderMap(['DemoHeader' => $header]);

        $securityScheme = $this->createReference('https://example.com/schema.json#/securitySchemes/SecurityScheme');
        $securitySchemes = $this->createSecuritySchemeMap(['SecurityScheme' => $securityScheme]);

        $link = $this->createLink('readPet');
        $links = $this->createLinkMap(['FooLink' => $link]);

        $callback = $this->createCallbackRequest(
            [
                'https://example.com/?email={$request.body#/email}' => $this->createPath(
                    null,
                    $this->createReference('#/components/schemas/webhook-path-schema')
                ),
            ]
        );
        $callbacks = $this->createCallbackRequestMap(['FooCallback' => $callback]);

        $example = $this->createReference('https://example.com/schema.json#/examples/FooExample');
        $examples = $this->createExampleMap(['FooExample' => $example]);

        $object = $this->createComponentMap(
            $schemas,
            $responses,
            $parameters,
            $requestBodies,
            $headers,
            $securitySchemes,
            $links,
            $callbacks,
            $examples,
            $this->createExtensionMap(['x-foo' => 'bar'])
        );
        self::assertJsonObject(
            [
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
                'securitySchemes' => [
                    'SecurityScheme' => [
                        '$ref' => 'https://example.com/schema.json#/securitySchemes/SecurityScheme',
                    ],
                ],
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
                'x-foo' => 'bar',
            ],
            $object
        );
    }
}
