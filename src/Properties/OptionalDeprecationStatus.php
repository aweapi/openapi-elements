<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

trait OptionalDeprecationStatus
{
    private $deprecated = false;

    public function isDeprecated(): bool
    {
        return $this->deprecated;
    }
}
