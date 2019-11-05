<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class HeaderBuilder implements Objects\HeaderFactory
{
    use Properties\OptionalExtensions;

    private $allowEmptyValue = false;

    private $allowReserved = false;

    private $content;

    private $deprecated = false;

    private $description;

    private $examples;

    private $explode;

    private $required;

    private $schema;

    private $style;

    public function createHeader(): Objects\Header
    {
        return new Objects\Header(
            $this->getSchema() ? $this->getSchema()->createSchemaAggregate() : null,
            $this->getContent() ? $this->getContent()->createMediaTypes() : null,
            $this->getDescription(),
            $this->isRequired(),
            $this->isDeprecated(),
            $this->isAllowEmptyValue(),
            $this->getStyle(),
            $this->isExplode(),
            $this->isAllowReserved(),
            $this->getExamples() ? $this->getExamples()->createExamples() : null,
            $this->getExtensions()
        );
    }

    public function createHeaderAggregate(): Objects\HeaderAggregate
    {
        return $this->createHeader();
    }

    public function setAllowEmptyValue(bool $allowEmptyValue): self
    {
        $this->allowEmptyValue = $allowEmptyValue;

        return $this;
    }

    public function setAllowReserved(bool $allowReserved): self
    {
        $this->allowReserved = $allowReserved;

        return $this;
    }

    public function setContent(Objects\MediaTypesFactory $content): self
    {
        $this->content = $content;

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

    public function setExamples(Objects\ExamplesFactory $examples): self
    {
        $this->examples = $examples;

        return $this;
    }

    public function setExplode(bool $explode): self
    {
        $this->explode = $explode;

        return $this;
    }

    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }

    public function setSchema(Objects\SchemaAggregateFactory $schema): self
    {
        $this->schema = $schema;

        return $this;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    private function getContent(): ?Objects\MediaTypesFactory
    {
        return $this->content;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getExamples(): ?Objects\ExamplesFactory
    {
        return $this->examples;
    }

    private function getSchema(): ?Objects\SchemaAggregateFactory
    {
        return $this->schema;
    }

    private function getStyle(): ?string
    {
        return $this->style;
    }

    private function isAllowEmptyValue(): bool
    {
        return $this->allowEmptyValue;
    }

    private function isAllowReserved(): bool
    {
        return $this->allowReserved;
    }

    private function isDeprecated(): bool
    {
        return $this->deprecated;
    }

    private function isExplode(): ?bool
    {
        return $this->explode;
    }

    private function isRequired(): ?bool
    {
        return $this->required;
    }
}
