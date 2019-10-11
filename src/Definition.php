<?php

declare(strict_types=1);

namespace Waspes\Objects;

use JsonSerializable;

interface Definition extends JsonSerializable
{
    public function jsonSerialize(): ?array;
}
