<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface CallbackRequestsFactory
{
    public function createCallbackRequests(): CallbackRequests;
}
