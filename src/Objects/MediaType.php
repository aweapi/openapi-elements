<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class MediaType extends ValueObject
{
    use Properties\OptionalExamples;
    use Properties\OptionalExtensions;

    private $encodings;

    private $schema;

    public function __construct(
        SchemaAggregate $schema = null,
        Examples $examples = null,
        Encodings $encodings = null,
        Extensions $extensions = null
    ) {
        $this->schema = $schema;
        $this->examples = $examples;
        $this->encodings = $encodings;
        $this->extensions = $extensions;
    }

    public function getEncodings(): Encodings
    {
        return $this->encodings;
    }

    public function getSchema(): SchemaAggregate
    {
        return $this->schema;
    }

    public function hasEncodings(): bool
    {
        return isset($this->encodings);
    }

    public function hasSchema(): bool
    {
        return isset($this->schema);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'schema' => $this->hasSchema() ? $this->getSchema()->jsonSerialize() : null,
            'examples' => $this->getNormalizedExamples(),
            'encoding' => $this->hasEncodings() ? $this->getEncodings()->jsonSerialize() : null,
        ];
    }
}
