<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface RequestBodyFactory
{
    public function createRequestBody(): RequestBody;
}
