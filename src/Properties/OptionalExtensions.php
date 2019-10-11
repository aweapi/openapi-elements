<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

use Waspes\Objects\ExtensionMap;

trait OptionalExtensions
{
    private $extensions;

    private function extendedProperties(?array $properties): ?array
    {
        return $this->hasExtensions()
            ? $this->getExtensions()->extendValues($properties)
            : $properties;
    }

    private function getExtensions(): ExtensionMap
    {
        return $this->extensions;
    }

    private function hasExtensions(): bool
    {
        return isset($this->extensions);
    }
}
