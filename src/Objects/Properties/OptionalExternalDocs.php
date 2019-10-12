<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

use Aweapi\Openapi\Objects\ExternalDocumentation;

trait OptionalExternalDocs
{
    private $externalDocs;

    public function getExternalDocs(): ExternalDocumentation
    {
        return $this->externalDocs;
    }

    public function hasExternalDocs(): bool
    {
        return isset($this->externalDocs);
    }

    private function getNormalizedExternalDocs(): ?array
    {
        return $this->hasExternalDocs() ? $this->getExternalDocs()->jsonSerialize() : null;
    }
}
