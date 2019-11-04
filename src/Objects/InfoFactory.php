<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface InfoFactory
{
    public function createInfo(): Info;
}
