<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface HeaderAggregateFactory
{
    public function createHeaderAggregate(): HeaderAggregate;
}
