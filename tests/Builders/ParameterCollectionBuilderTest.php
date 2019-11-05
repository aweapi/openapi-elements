<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ParameterCollectionBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForParameters(): void
    {
        $factory = $this->getBuilderFactory();
        $collection = $factory->parameterCollection()
            ->addParameters(
                $factory->parameter()
                    ->setName('id')
                    ->setIn('path')
            )
            ->createParameterCollection()
        ;
        self::assertJsonObject([
            [
                'name' => 'id',
                'in' => 'path',
            ],
        ], $collection);
    }
}
