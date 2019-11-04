<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ReferenceBuilder implements Objects\ReferenceFactory
{
    private $href;

    public function createReference(): Objects\Reference
    {
        return new Objects\Reference(
            $this->getHref()
        );
    }

    public function createSchemaAggregate(): Objects\SchemaAggregate
    {
        return $this->createReference();
    }

    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    private function getHref(): string
    {
        return $this->href;
    }
}
