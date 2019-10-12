<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class Operation extends ValueObject
{
    use Properties\OptionalDeprecationStatus;
    use Properties\OptionalDescription;
    use Properties\OptionalExternalDocs;
    use Properties\OptionalExtensions;
    use Properties\OptionalServers;
    use Properties\OptionalSummary;
    use Properties\OptionalSecurityRequirements;
    use Properties\OptionalParameterCollection;
    use Properties\OptionalCallbacks;

    private $operationId;

    private $requestBody;

    private $responses;

    private $tags;

    public function __construct(
        OperationResponses $responses,
        RequestBody $requestBody = null,
        array $tags = [],
        string $operationId = null,
        string $summary = null,
        string $description = null,
        bool $deprecated = false,
        ParameterCollection $parameters = null,
        SecurityRequirementCollection $security = null,
        CallbackRequests $callbacks = null,
        ServerCollection $servers = null,
        ExternalDocumentation $externalDocs = null,
        Extensions $extensions = null
    ) {
        $this->responses = $responses;
        $this->requestBody = $requestBody;
        $this->tags = $tags;
        $this->operationId = $operationId;
        $this->summary = $summary;
        $this->description = $description;
        $this->deprecated = $deprecated;
        $this->parameters = $parameters;
        $this->security = $security;
        $this->callbacks = $callbacks;
        $this->servers = $servers;
        $this->externalDocs = $externalDocs;
        $this->extensions = $extensions;
    }

    public function getOperationId(): string
    {
        return $this->operationId;
    }

    public function getRequestBody(): ValueObject
    {
        return $this->requestBody;
    }

    public function getResponses(): OperationResponses
    {
        return $this->responses;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function hasOperationId(): bool
    {
        return isset($this->operationId);
    }

    public function hasRequestBody(): bool
    {
        return isset($this->requestBody);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'requestBody' => $this->hasRequestBody() ? $this->getRequestBody()->jsonSerialize() : null,
            'tags' => $this->getTags(),
            'operationId' => $this->hasOperationId() ? $this->getOperationId() : null,
            'summary' => $this->getNormalizedSummary(),
            'description' => $this->getNormalizedDescription(),
            'deprecated' => $this->isDeprecated() ?: null,
            'parameters' => $this->getNormalizedParameters(),
            'security' => $this->getNormalizedSecurity(),
            'callbacks' => $this->getNormalizedCallbacks(),
            'servers' => $this->getNormalizedServers(),
            'externalDocs' => $this->getNormalizedExternalDocs(),
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'responses' => $this->getResponses()->jsonSerialize() ?: self::emptyObject(),
        ];
    }
}
