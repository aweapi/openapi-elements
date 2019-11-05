<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface LinksFactory
{
    public function createLinks(): Links;
}
