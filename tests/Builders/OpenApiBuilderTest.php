<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Openapi\Objects\OpenApi;
use Aweapi\Tests\Openapi\TestCase;
use stdClass;

final class OpenApiBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->openapi()
            ->setOpenapi(OpenApi::LATEST_VERSION)
            ->setInfo(
                $factory->info()
                    ->setTitle('Pets API')
                    ->setVersion('1.0')
            )
            ->setPaths(
                $factory->paths()
                    ->setPath('/pets/{petId}', $factory->path()->setSummary('Pets API'))
            )
            ->setServers(
                $factory->serverCollection()
                    ->addServers(
                        $factory->server()->setUrl('https://example.com')
                    )
            )
            ->setComponents(
                $factory->components()
                    ->setSchemas(
                        $factory->schemas()
                            ->setSchema('DemoSchema', $factory->schema()->setAttributes(['type' => 'string']))
                    )
            )
            ->setSecurity(
                $factory->securityRequirementCollection()
                    ->addSecurityRequirements(
                        $factory->securityRequirement()
                            ->setItem('petstore_auth', ['write:pets', 'read:pets'])
                    )
            )
            ->setTags(
                $factory->tagCollection()
                    ->addTags($factory->tag()->setName('pets'))
            )
            ->setExternalDocs(
                $factory->externalDocs()
                    ->setUrl('https://example.com/docs')
            )
            ->addExtensions(['x-foo' => null])
            ->createOpenApi()
        ;
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
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();
        $object = $factory->openapi()
            ->setOpenapi(OpenApi::LATEST_VERSION)
            ->setInfo(
                $factory->info()
                    ->setTitle('Pets API')
                    ->setVersion('1.0')
            )
            ->setPaths($factory->paths())
            ->createOpenApi()
        ;
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
