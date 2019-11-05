<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface OperationResponsesFactory
{
    public function createOperationResponses(): OperationResponses;
}
