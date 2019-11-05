<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface MediaTypesFactory
{
    public function createMediaTypes(): MediaTypes;
}
