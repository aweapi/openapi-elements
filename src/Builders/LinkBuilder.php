<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class LinkBuilder implements Objects\LinkFactory
{
    use Properties\OptionalExtensions;

    private $description;

    private $operationId;

    private $operationRef;

    private $parameters = [];

    private $requestBody;

    private $server;

    public function createLink(): Objects\Link
    {
        return new Objects\Link(
            $this->getOperationId(),
            $this->getOperationRef(),
            $this->getDescription(),
            $this->getParameters(),
            $this->getRequestBody(),
            $this->getServer() ? $this->getServer()->createServer() : null,
            $this->getExtensions()
        );
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setOperationId(string $operationId): self
    {
        $this->operationId = $operationId;

        return $this;
    }

    public function setOperationRef(string $operationRef): self
    {
        $this->operationRef = $operationRef;

        return $this;
    }

    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @param mixed $requestBody
     */
    public function setRequestBody($requestBody): self
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    public function setServer(Objects\ServerFactory $server): self
    {
        $this->server = $server;

        return $this;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getOperationId(): ?string
    {
        return $this->operationId;
    }

    private function getOperationRef(): ?string
    {
        return $this->operationRef;
    }

    private function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    private function getRequestBody()
    {
        return $this->requestBody;
    }

    private function getServer(): ?Objects\ServerFactory
    {
        return $this->server;
    }
}
