<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Tag extends ValueObject
{
    use Properties\OptionalDescription;
    use Properties\OptionalExternalDocs;
    use Properties\OptionalExtensions;

    private $name;

    public function __construct(
        string $name,
        string $description = null,
        ExternalDocumentation $externalDocs = null,
        ExtensionMap $extensions = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->externalDocs = $externalDocs;
        $this->extensions = $extensions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'description' => $this->getNormalizedDescription(),
            'externalDocs' => $this->getNormalizedExternalDocs(),
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'name' => $this->getName(),
        ];
    }
}
