<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;
use InvalidArgumentException;

final class PathBuilder implements Objects\PathFactory
{
    use Properties\OptionalExtensions;

    private $description;

    private $operations = [
        Objects\Path::METHOD_GET => null,
        Objects\Path::METHOD_PUT => null,
        Objects\Path::METHOD_POST => null,
        Objects\Path::METHOD_DELETE => null,
        Objects\Path::METHOD_PATCH => null,
        Objects\Path::METHOD_OPTIONS => null,
        Objects\Path::METHOD_HEAD => null,
        Objects\Path::METHOD_TRACE => null,
    ];

    private $parameters;

    private $reference;

    private $servers;

    private $summary;

    public function createPath(): Objects\Path
    {
        return new Objects\Path(
            $this->getSummary(),
            $this->getReference() ? $this->getReference()->createReference() : null,
            $this->getDescription(),
            $this->getOperation(Objects\Path::METHOD_GET)
                ? $this->getOperation(Objects\Path::METHOD_GET)->createOperation()
                : null,
            $this->getOperation(Objects\Path::METHOD_PUT)
                ? $this->getOperation(Objects\Path::METHOD_PUT)->createOperation()
                : null,
            $this->getOperation(Objects\Path::METHOD_POST)
                ? $this->getOperation(Objects\Path::METHOD_POST)->createOperation()
                : null,
            $this->getOperation(Objects\Path::METHOD_DELETE)
                ? $this->getOperation(Objects\Path::METHOD_DELETE)->createOperation()
                : null,
            $this->getOperation(Objects\Path::METHOD_PATCH)
                ? $this->getOperation(Objects\Path::METHOD_PATCH)->createOperation()
                : null,
            $this->getOperation(Objects\Path::METHOD_OPTIONS)
                ? $this->getOperation(Objects\Path::METHOD_OPTIONS)->createOperation()
                : null,
            $this->getOperation(Objects\Path::METHOD_HEAD)
                ? $this->getOperation(Objects\Path::METHOD_HEAD)->createOperation()
                : null,
            $this->getOperation(Objects\Path::METHOD_TRACE)
                ? $this->getOperation(Objects\Path::METHOD_TRACE)->createOperation()
                : null,
            $this->getServers() ? $this->getServers()->createServerCollection() : null,
            $this->getParameters() ? $this->getParameters()->createParameterCollection() : null,
            $this->getExtensions()
        );
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setOperation(string $method, Objects\OperationFactory $operation): self
    {
        $method = mb_strtolower($method);

        if (!array_key_exists($method, $this->operations)) {
            throw new InvalidArgumentException(sprintf('The method "%s" is not supported', $method));
        }

        $this->operations[$method] = $operation;

        return $this;
    }

    public function setParameters(Objects\ParameterCollectionFactory $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function setReference(Objects\ReferenceFactory $reference): self
    {
        $this->reference = $reference;

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

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getOperation(string $method): ?Objects\OperationFactory
    {
        return $this->operations[mb_strtolower($method)];
    }

    private function getParameters(): ?Objects\ParameterCollectionFactory
    {
        return $this->parameters;
    }

    private function getReference(): ?Objects\ReferenceFactory
    {
        return $this->reference;
    }

    private function getServers(): ?Objects\ServerCollectionFactory
    {
        return $this->servers;
    }

    private function getSummary(): ?string
    {
        return $this->summary;
    }
}
