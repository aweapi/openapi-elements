<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface OpenApiFactory
{
    public function createOpenApi(): OpenApi;
}
