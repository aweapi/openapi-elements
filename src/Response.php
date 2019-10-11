<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Response extends ValueObject implements ResponseAggregate
{
    use Properties\Description;
    use Properties\OptionalMediaTypeContent;
    use Properties\OptionalExtensions;

    private $headers;

    private $links;

    public function __construct(
        string $description,
        HeaderMap $headers = null,
        MediaTypeMap $content = null,
        LinkMap $links = null,
        ExtensionMap $extensions = null
    ) {
        $this->description = $description;
        $this->headers = $headers;
        $this->content = $content;
        $this->links = $links;
        $this->extensions = $extensions;
    }

    public function getHeaders(): HeaderMap
    {
        return $this->headers;
    }

    public function getLinks(): LinkMap
    {
        return $this->links;
    }

    public function hasHeaders(): bool
    {
        return isset($this->headers);
    }

    public function hasLinks(): bool
    {
        return isset($this->links);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'headers' => $this->hasHeaders() ? $this->getHeaders()->jsonSerialize() : null,
            'content' => $this->getNormalizedContent(),
            'links' => $this->hasLinks() ? $this->getLinks()->jsonSerialize() : null,
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'description' => $this->getDescription(),
        ];
    }
}
