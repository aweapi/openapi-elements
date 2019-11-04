<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ResponseFactory extends ResponseAggregateFactory
{
    public function createResponse(): Response;
}
