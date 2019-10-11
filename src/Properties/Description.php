<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

trait Description
{
    private $description;

    public function getDescription(): string
    {
        return $this->description;
    }
}
