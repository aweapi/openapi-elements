<?php

declare(strict_types=1);

namespace Waspes\Objects;

final class Path extends ValueObject
{
    use Properties\OptionalDescription;
    use Properties\OptionalServers;
    use Properties\OptionalExtensions;
    use Properties\OptionalSummary;
    use Properties\OptionalParameterCollection;

    public const METHOD_DELETE = 'delete';

    public const METHOD_GET = 'get';

    public const METHOD_HEAD = 'head';

    public const METHOD_OPTIONS = 'options';

    public const METHOD_PATCH = 'patch';

    public const METHOD_POST = 'post';

    public const METHOD_PUT = 'put';

    public const METHOD_TRACE = 'trace';

    private $operations;

    private $ref;

    public function __construct(
        string $summary = null,
        Reference $ref = null,
        string $description = null,
        Operation $getOperation = null,
        Operation $putOperation = null,
        Operation $postOperation = null,
        Operation $deleteOperation = null,
        Operation $patchOperation = null,
        Operation $optionsOperation = null,
        Operation $headOperation = null,
        Operation $traceOperation = null,
        ServerCollection $servers = null,
        ParameterCollection $parameters = null,
        Extensions $extensions = null
    ) {
        $this->summary = $summary;
        $this->ref = $ref;
        $this->description = $description;
        $this->operations = array_filter([
            self::METHOD_GET => $getOperation,
            self::METHOD_PUT => $putOperation,
            self::METHOD_POST => $postOperation,
            self::METHOD_DELETE => $deleteOperation,
            self::METHOD_PATCH => $patchOperation,
            self::METHOD_OPTIONS => $optionsOperation,
            self::METHOD_HEAD => $headOperation,
            self::METHOD_TRACE => $traceOperation,
        ]);
        $this->servers = $servers;
        $this->parameters = $parameters;
        $this->extensions = $extensions;
    }

    public function getOperation(string $method): Operation
    {
        return $this->operations[mb_strtolower($method)];
    }

    public function getRef(): Reference
    {
        return $this->ref;
    }

    public function hasOperation(string $method): bool
    {
        return isset($this->operations[mb_strtolower($method)]);
    }

    public function hasRef(): bool
    {
        return isset($this->ref);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        $properties = [
            'summary' => $this->getNormalizedSummary(),
            'description' => $this->getNormalizedDescription(),
            'servers' => $this->getNormalizedServers(),
            'parameters' => $this->getNormalizedParameters(),
        ];

        foreach ($this->getOperations() as $method => $operation) {
            $properties[$method] = $operation->jsonSerialize();
        }

        if ($this->hasRef()) {
            return (array) $this->getRef()->jsonSerialize() + $properties;
        }

        return $properties;
    }

    /**
     * @return Operation[]
     */
    private function getOperations(): array
    {
        return $this->operations;
    }
}
