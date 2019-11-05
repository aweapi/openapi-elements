<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;
use InvalidArgumentException;

final class PathBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function failsOnUnsupportedMethod(): void
    {
        $factory = $this->getBuilderFactory();

        $this->expectExceptionObject(new InvalidArgumentException('The method "unknown-method" is not supported'));
        $factory->path()
            ->setOperation('unknown-method', $factory->operation())
        ;
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $factory = $this->getBuilderFactory();

        $summary = 'Summary';
        $description = 'Description';
        $href = '#/components/schemas/PetEndpoint';
        $serverUrl = 'https://example.com';

        $get = $factory->operation()
            ->setResponses(
                $factory->operationResponses()
                    ->setDefault($factory->response()->setDescription('Get pet'))
            )
        ;

        $options = $factory->operation()
            ->setResponses(
                $factory->operationResponses()
                    ->setDefault($factory->response()->setDescription('Endpoint options'))
            )
        ;

        $object = $factory->path()
            ->setReference($factory->ref()->setHref($href))
            ->setSummary($summary)
            ->setDescription($description)
            ->setServers(
                $factory->serverCollection()
                    ->addServers(
                        $factory->server()->setUrl($serverUrl)
                    )
            )
            ->setParameters(
                $factory->parameterCollection()
                    ->addParameters(
                        $factory->parameter()
                            ->setName('id')
                            ->setIn('path')
                    )
            )
            ->setOperation('get', $get)
            ->setOperation('options', $options)
            ->addExtensions(['x-foo' => null])
            ->createPath()
        ;
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
        $factory = $this->getBuilderFactory();
        $object = $factory->path()
            ->createPath()
        ;
        self::assertNull($object->jsonSerialize());
    }
}
