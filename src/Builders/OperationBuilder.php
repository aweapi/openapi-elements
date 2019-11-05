<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class OperationBuilder implements Objects\OperationFactory
{
    use Properties\OptionalExtensions;

    private $callbacks;

    private $deprecated = false;

    private $description;

    private $externalDocs;

    private $operationId;

    private $parameters;

    private $requestBody;

    private $responses;

    private $security;

    private $servers;

    private $summary;

    private $tags = [];

    public function createOperation(): Objects\Operation
    {
        return new Objects\Operation(
            $this->getResponses()->createOperationResponses(),
            $this->getRequestBody() ? $this->getRequestBody()->createRequestBody() : null,
            $this->getTags(),
            $this->getOperationId(),
            $this->getSummary(),
            $this->getDescription(),
            $this->isDeprecated(),
            $this->getParameters() ? $this->getParameters()->createParameterCollection() : null,
            $this->getSecurity() ? $this->getSecurity()->createSecurityRequirementCollection() : null,
            $this->getCallbacks() ? $this->getCallbacks()->createCallbackRequests() : null,
            $this->getServers() ? $this->getServers()->createServerCollection() : null,
            $this->getExternalDocs() ? $this->getExternalDocs()->createExternalDocumentation() : null,
            $this->getExtensions()
        );
    }

    public function setCallbacks(Objects\CallbackRequestsFactory $callbacks): self
    {
        $this->callbacks = $callbacks;

        return $this;
    }

    public function setDeprecated(bool $deprecated): self
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setExternalDocs(Objects\ExternalDocumentationFactory $externalDocs): self
    {
        $this->externalDocs = $externalDocs;

        return $this;
    }

    public function setOperationId(string $operationId): self
    {
        $this->operationId = $operationId;

        return $this;
    }

    public function setParameters(Objects\ParameterCollectionFactory $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function setRequestBody(Objects\RequestBodyFactory $requestBody): self
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    public function setResponses(Objects\OperationResponsesFactory $responses): self
    {
        $this->responses = $responses;

        return $this;
    }

    public function setSecurity(Objects\SecurityRequirementCollectionFactory $security): self
    {
        $this->security = $security;

        return $this;
    }

    public function setServers(Objects\ServerCollectionFactory $servers): self
    {
        $this->servers = $servers;

        return $this;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    private function getCallbacks(): ?Objects\CallbackRequestsFactory
    {
        return $this->callbacks;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getExternalDocs(): ?Objects\ExternalDocumentationFactory
    {
        return $this->externalDocs;
    }

    private function getOperationId(): ?string
    {
        return $this->operationId;
    }

    private function getParameters(): ?Objects\ParameterCollectionFactory
    {
        return $this->parameters;
    }

    private function getRequestBody(): ?Objects\RequestBodyFactory
    {
        return $this->requestBody;
    }

    private function getResponses(): Objects\OperationResponsesFactory
    {
        return $this->responses;
    }

    private function getSecurity(): ?Objects\SecurityRequirementCollectionFactory
    {
        return $this->security;
    }

    private function getServers(): ?Objects\ServerCollectionFactory
    {
        return $this->servers;
    }

    private function getSummary(): ?string
    {
        return $this->summary;
    }

    private function getTags(): array
    {
        return $this->tags;
    }

    private function isDeprecated(): bool
    {
        return $this->deprecated;
    }
}
