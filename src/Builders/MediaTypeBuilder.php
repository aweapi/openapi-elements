<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class MediaTypeBuilder implements Objects\MediaTypeFactory
{
    use Properties\OptionalExtensions;

    private $encodings;

    private $examples;

    private $schema;

    public function createMediaType(): Objects\MediaType
    {
        return new Objects\MediaType(
            $this->getSchema() ? $this->getSchema()->createSchemaAggregate() : null,
            $this->getExamples() ? $this->getExamples()->createExamples() : null,
            $this->getEncodings() ? $this->getEncodings()->createEncodings() : null,
            $this->getExtensions()
        );
    }

    public function setEncodings(Objects\EncodingsFactory $encodings): self
    {
        $this->encodings = $encodings;

        return $this;
    }

    public function setExamples(Objects\ExamplesFactory $examples): self
    {
        $this->examples = $examples;

        return $this;
    }

    public function setSchema(Objects\SchemaAggregateFactory $schema): self
    {
        $this->schema = $schema;

        return $this;
    }

    private function getEncodings(): ?Objects\EncodingsFactory
    {
        return $this->encodings;
    }

    private function getExamples(): ?Objects\ExamplesFactory
    {
        return $this->examples;
    }

    private function getSchema(): ?Objects\SchemaAggregateFactory
    {
        return $this->schema;
    }
}
