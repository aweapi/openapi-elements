<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ParametersBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForParameters(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->parameters()
            ->addParameters([
                'ExampleParameter' => $factory->parameter()
                    ->setName('id')
                    ->setIn('path'),
            ])
            ->createParameters()
        ;
        self::assertJsonObject([
            'ExampleParameter' => ['name' => 'id', 'in' => 'path'],
        ], $map);
    }
}
