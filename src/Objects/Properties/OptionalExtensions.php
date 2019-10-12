<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

use Aweapi\Openapi\Extensions;

trait OptionalExtensions
{
    private $extensions;

    private function extendedProperties(?array $properties): ?array
    {
        return $this->hasExtensions()
            ? $this->getExtensions()->extendValues($properties)
            : $properties;
    }

    private function getExtensions(): Extensions
    {
        return $this->extensions;
    }

    private function hasExtensions(): bool
    {
        return isset($this->extensions);
    }
}
