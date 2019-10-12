<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi\Objects;

use Aweapi\Tests\Openapi\TestCase;
use stdClass;

final class RequestBodyTest extends TestCase
{
    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createRequestBody(
            $this->createMediaTypes([]),
            'Description',
            true,
            $this->createExtensions(['x-foo' => null])
        );
        self::assertJsonObject([
            'content' => new stdClass(),
            'description' => 'Description',
            'required' => true,
            'x-foo' => null,
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createRequestBody(
            $this->createMediaTypes([])
        );
        self::assertJsonObject([
            'content' => new stdClass(),
        ], $object);
    }
}
