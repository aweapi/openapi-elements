<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ResponseAggregateFactory
{
    public function createResponseAggregate(): ResponseAggregate;
}
