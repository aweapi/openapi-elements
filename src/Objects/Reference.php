<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Definition;

final class Reference implements
    Definition,
    SchemaAggregate,
    ResponseAggregate,
    ParameterAggregate,
    RequestBodyAggregate,
    HeaderAggregate,
    SecuritySchemeAggregate,
    ExampleAggregate,
    LinkAggregate
{
    private $href;

    public function __construct(string $href)
    {
        $this->href = $href;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function jsonSerialize(): ?array
    {
        return [
            '$ref' => $this->getHref(),
        ];
    }
}
