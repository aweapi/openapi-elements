<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Builders;

use Aweapi\Tests\Openapi\TestCase;

final class ServerVariablesBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedForVariables(): void
    {
        $factory = $this->getBuilderFactory();
        $map = $factory->serverVariables()
            ->addVariables([
                'id' => $factory->serverVariable()
                    ->setDefault(true),
            ])
            ->createServerVariables()
        ;
        self::assertJsonObject([
            'id' => ['default' => true],
        ], $map);
    }
}
