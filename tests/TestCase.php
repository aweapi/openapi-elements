<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi;

use Aweapi\Openapi\BuilderFactory;
use JsonSerializable;
use PHPUnit\Framework;

abstract class TestCase extends Framework\TestCase
{
    use TestFactory;

    final protected static function assertJsonObject(array $expectedValues, JsonSerializable $actual): void
    {
        self::assertSame(
            json_encode($expectedValues, JSON_PRETTY_PRINT),
            json_encode($actual, JSON_PRETTY_PRINT)
        );
    }

    final protected function getBuilderFactory(): BuilderFactory
    {
        return new BuilderFactory();
    }
}
