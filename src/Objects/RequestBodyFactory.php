<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface RequestBodyFactory extends RequestBodyAggregateFactory
{
    public function createRequestBody(): RequestBody;
}
