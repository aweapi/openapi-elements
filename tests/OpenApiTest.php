<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use stdClass;
use Waspes\Objects\OpenApi;

final class OpenApiTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $path = $this->createPath('Pets API');
        $paths = [
            '/pets/{petId}' => $path,
        ];
        $server = $this->createServer('https://example.com');
        $schema = $this->createSchema(['type' => 'string']);
        $schemas = $this->createSchemas(['DemoSchema' => $schema]);
        $components = $this->createComponents($schemas);
        $security = $this->createSecurityRequirementCollection([
            $this->createSecurityRequirement([
                'petstore_auth' => ['write:pets', 'read:pets'],
            ]),
        ]);
        $tags = $this->createTagCollection([$this->createTag('pets')]);
        $externalDocs = $this->createExternalDocumentation('https://example.com/docs');
        $object = $this->createOpenApi(
            OpenApi::LATEST_VERSION,
            $this->createInfo(
                'Pets API',
                '1.0'
            ),
            $this->createPaths($paths),
            $this->createServerCollection([$server]),
            $components,
            $security,
            $tags,
            $externalDocs,
            $this->createExtensions(['x-foo' => 'bar'])
        );
        self::assertJsonObject([
            'openapi' => OpenApi::LATEST_VERSION,
            'info' => [
                'title' => 'Pets API',
                'version' => '1.0',
            ],
            'paths' => [
                '/pets/{petId}' => [
                    'summary' => 'Pets API',
                ],
            ],
            'servers' => [
                ['url' => 'https://example.com'],
            ],
            'components' => [
                'schemas' => [
                    'DemoSchema' => ['type' => 'string'],
                ],
            ],
            'security' => [
                [
                    'petstore_auth' => ['write:pets', 'read:pets'],
                ],
            ],
            'tags' => [
                [
                    'name' => 'pets',
                ],
            ],
            'externalDocs' => [
                'url' => 'https://example.com/docs',
            ],
            'x-foo' => 'bar',
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createOpenApi(
            OpenApi::LATEST_VERSION,
            $this->createInfo(
                'Pets API',
                '1.0'
            ),
            $this->createPaths([])
        );
        self::assertJsonObject([
            'openapi' => OpenApi::LATEST_VERSION,
            'info' => [
                'title' => 'Pets API',
                'version' => '1.0',
            ],
            'paths' => new stdClass(),
            'servers' => [
                // Default server.
                ['url' => '/'],
            ],
        ], $object);
    }
}
