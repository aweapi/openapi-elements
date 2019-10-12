<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Server extends ValueObject
{
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;

    private $url;

    private $variables;

    public function __construct(
        string $url,
        string $description = null,
        ServerVariables $variables = null,
        Extensions $extensions = null
    ) {
        $this->url = $url;
        $this->description = $description;
        $this->variables = $variables;
        $this->extensions = $extensions;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getVariables(): ServerVariables
    {
        return $this->variables;
    }

    public function hasVariables(): bool
    {
        return isset($this->variables);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'description' => $this->getNormalizedDescription(),
            'variables' => $this->hasVariables() ? $this->getVariables()->jsonSerialize() : null,
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'url' => $this->getUrl(),
        ];
    }
}
