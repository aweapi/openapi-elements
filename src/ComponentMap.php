<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class ComponentMap extends ValueObject
{
    use Properties\OptionalExamples;
    use Properties\OptionalCallbacks;
    use Properties\OptionalExtensions;

    private $headers;

    private $links;

    private $parameters;

    private $requestBodies;

    private $responses;

    private $schemas;

    private $securitySchemes;

    public function __construct(
        SchemaMap $schemas = null,
        ResponseMap $responses = null,
        ParameterMap $parameters = null,
        RequestBodyMap $requestBodies = null,
        HeaderMap $headers = null,
        SecuritySchemeMap $securitySchemes = null,
        LinkMap $links = null,
        CallbackRequestMap $callbacks = null,
        ExampleMap $examples = null,
        ExtensionMap $extensions = null
    ) {
        $this->schemas = $schemas;
        $this->responses = $responses;
        $this->parameters = $parameters;
        $this->requestBodies = $requestBodies;
        $this->headers = $headers;
        $this->securitySchemes = $securitySchemes;
        $this->links = $links;
        $this->callbacks = $callbacks;
        $this->examples = $examples;
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

    public function getParameters(): ParameterMap
    {
        return $this->parameters;
    }

    public function getRequestBodies(): RequestBodyMap
    {
        return $this->requestBodies;
    }

    public function getResponses(): ResponseMap
    {
        return $this->responses;
    }

    public function getSchemas(): SchemaMap
    {
        return $this->schemas;
    }

    public function getSecuritySchemes(): SecuritySchemeMap
    {
        return $this->securitySchemes;
    }

    public function hasHeaders(): bool
    {
        return isset($this->headers);
    }

    public function hasLinks(): bool
    {
        return isset($this->links);
    }

    public function hasParameters(): bool
    {
        return isset($this->parameters);
    }

    public function hasRequestBodies(): bool
    {
        return isset($this->requestBodies);
    }

    public function hasResponses(): bool
    {
        return isset($this->responses);
    }

    public function hasSchemas(): bool
    {
        return isset($this->schemas);
    }

    public function hasSecuritySchemes(): bool
    {
        return isset($this->securitySchemes);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'schemas' => $this->hasSchemas() ? $this->getSchemas()->jsonSerialize() : null,
            'responses' => $this->hasResponses() ? $this->getResponses()->jsonSerialize() : null,
            'parameters' => $this->hasParameters() ? $this->getParameters()->jsonSerialize() : null,
            'requestBodies' => $this->hasRequestBodies() ? $this->getRequestBodies()->jsonSerialize() : null,
            'headers' => $this->hasHeaders() ? $this->getHeaders()->jsonSerialize() : null,
            'securitySchemes' => $this->hasSecuritySchemes() ? $this->getSecuritySchemes()->jsonSerialize() : null,
            'links' => $this->hasLinks() ? $this->getLinks() : null,
            'callbacks' => $this->getNormalizedCallbacks(),
            'examples' => $this->getNormalizedExamples(),
        ];
    }
}
