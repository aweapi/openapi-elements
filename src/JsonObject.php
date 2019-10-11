<?php

declare(strict_types=1);

namespace Waspes\Objects;

use JsonSerializable;
use stdClass;

final class JsonObject implements JsonSerializable
{
    private $data = [];

    public function jsonSerialize()
    {
        return $this->data ?: self::emptyObject();
    }

    /**
     * @param mixed $value
     */
    public function setOptionalProperty(string $name, $value): void
    {
        if (!self::isEmpty($value)) {
            $this->setRequiredProperty($name, $value);
        }
    }

    /**
     * @param mixed $value
     */
    public function setRequiredNestedProperty(string $name, $value): void
    {
        $this->setRequiredProperty(
            $name,
            self::isEmpty($value)
                ? self::emptyObject()
                : $value
        );
    }

    /**
     * @param mixed $value
     */
    public function setRequiredProperty(string $name, $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * Use this instead of empty maps for required properties to force JSON-object.
     */
    private static function emptyObject(): stdClass
    {
        return new stdClass();
    }

    /**
     * @param mixed $value
     */
    private static function isEmpty($value): bool
    {
        if ($value instanceof JsonSerializable) {
            return self::isEmpty($value->jsonSerialize());
        }

        return empty($value);
    }
}
