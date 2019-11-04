<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface HeaderFactory
{
    public function createHeader(): Header;
}
