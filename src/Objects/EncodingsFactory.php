<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface EncodingsFactory
{
    public function createEncodings(): Encodings;
}
