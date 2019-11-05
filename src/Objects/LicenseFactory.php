<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

interface LicenseFactory
{
    public function createLicense(): License;
}
