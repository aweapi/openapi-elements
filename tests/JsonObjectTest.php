<?php

declare(strict_types=1);

namespace Waspes\Tests\Objects;

use stdClass;
use Waspes\Objects\JsonObject;

final class JsonObjectTest extends TestCase
{
    /**
     * @test
     */
    public function isJsonSerializable(): void
    {
        $value = new JsonObject();

        $value->setOptionalProperty('optional_nullable', null);
        $value->setOptionalProperty('optional_empty', '');
        $value->setOptionalProperty('optional_false', false);
        $value->setOptionalProperty('optional_zero', 0);
        $value->setOptionalProperty('optional_empty_array', []);
        $value->setOptionalProperty('optional_value', 'foo');

        $value->setRequiredProperty('required_nullable', null);
        $value->setRequiredProperty('required_value', 'foo');
        $value->setRequiredNestedProperty('required_empty_array', []);
        $value->setRequiredNestedProperty('required_filled_array', ['foo']);

        // Add more properties to verify order.
        $value->setOptionalProperty('optional_value_after_required', 'foo');
        $value->setRequiredProperty('required_value_after_optional', 'foo');

        $value->setOptionalProperty('nested_object', new JsonObject());

        $nullObject = new stdClass();

        self::assertSame(
            json_encode([
                'optional_value' => 'foo',
                'required_nullable' => null,
                'required_value' => 'foo',
                'required_empty_array' => $nullObject,
                'required_filled_array' => ['foo'],
                'optional_value_after_required' => 'foo',
                'required_value_after_optional' => 'foo',
                'nested_object' => $nullObject,
            ], JSON_PRETTY_PRINT),
            json_encode($value, JSON_PRETTY_PRINT)
        );
    }
}
