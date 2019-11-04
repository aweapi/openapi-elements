<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface ResponsesFactory
{
    public function createResponses(): Responses;
}
