<?php

declare(strict_types=1);

namespace Waspes\Objects;

use InvalidArgumentException;

final class Link extends ValueObject implements LinkAggregate
{
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;

    private $operationId;

    private $operationRef;

    private $parameters;

    private $requestBody;

    private $server;

    /**
     * @param mixed $requestBody
     */
    public function __construct(
        string $operationId = null,
        string $operationRef = null,
        string $description = null,
        array $parameters = [],
        $requestBody = null,
        Server $server = null,
        Extensions $extensions = null
    ) {
        if (!empty($operationId) && !empty($operationRef)) {
            throw new InvalidArgumentException('The Link operationId and operationRef are mutually exclusive');
        }

        if (empty($operationId) && empty($operationRef)) {
            throw new InvalidArgumentException('The Link must have either operationId or operationRef');
        }

        $this->operationId = $operationId;
        $this->operationRef = $operationRef;
        $this->description = $description;
        $this->parameters = $parameters;
        $this->requestBody = $requestBody;
        $this->server = $server;
        $this->extensions = $extensions;
    }

    public function getOperationId(): string
    {
        return $this->operationId;
    }

    public function getOperationRef(): string
    {
        return $this->operationRef;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    public function getServer(): Server
    {
        return $this->server;
    }

    public function hasOperationId(): bool
    {
        return isset($this->operationId);
    }

    public function hasOperationRef(): bool
    {
        return isset($this->operationRef);
    }

    public function hasServer(): bool
    {
        return isset($this->server);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'operationId' => $this->hasOperationId() ? $this->getOperationId() : null,
            'operationRef' => $this->hasOperationRef() ? $this->getOperationRef() : null,
            'description' => $this->getNormalizedDescription(),
            'parameters' => $this->getParameters(),
            'requestBody' => $this->getRequestBody(),
            'server' => $this->hasServer() ? $this->getServer() : null,
        ];
    }
}
