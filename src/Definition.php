<?php

declare(strict_types=1);

namespace Aweapi\Openapi;

use JsonSerializable;

interface Definition extends JsonSerializable
{
    public function jsonSerialize(): ?array;
}
