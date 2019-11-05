<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface CallbackRequestFactory
{
    public function createCallbackRequest(): CallbackRequest;
}
