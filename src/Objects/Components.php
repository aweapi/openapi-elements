<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class Components extends ValueObject
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
        Schemas $schemas = null,
        Responses $responses = null,
        Parameters $parameters = null,
        RequestBodies $requestBodies = null,
        Headers $headers = null,
        SecuritySchemes $securitySchemes = null,
        Links $links = null,
        CallbackRequests $callbacks = null,
        Examples $examples = null,
        Extensions $extensions = null
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

    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    public function getLinks(): Links
    {
        return $this->links;
    }

    public function getParameters(): Parameters
    {
        return $this->parameters;
    }

    public function getRequestBodies(): RequestBodies
    {
        return $this->requestBodies;
    }

    public function getResponses(): Responses
    {
        return $this->responses;
    }

    public function getSchemas(): Schemas
    {
        return $this->schemas;
    }

    public function getSecuritySchemes(): SecuritySchemes
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
