<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface MediaTypeFactory
{
    public function createMediaType(): MediaType;
}
