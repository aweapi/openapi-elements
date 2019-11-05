<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface HeaderFactory extends HeaderAggregateFactory
{
    public function createHeader(): Header;
}
