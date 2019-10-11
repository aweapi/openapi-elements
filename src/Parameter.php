<?php

declare(strict_types=1);

namespace Waspes\Objects;

class Parameter extends ValueObject implements ParameterAggregate
{
    use Properties\OptionalDeprecationStatus;
    use Properties\OptionalDescription;
    use Properties\OptionalExamples;
    use Properties\OptionalMediaTypeContent;
    use Properties\OptionalExtensions;

    private $allowEmptyValue;

    private $allowReserved;

    private $explode;

    private $in;

    private $name;

    private $required;

    private $schema;

    private $style;

    public function __construct(
        string $name,
        string $in,
        SchemaAggregate $schema = null,
        MediaTypeMap $content = null,
        string $description = null,
        bool $required = null,
        bool $deprecated = false,
        bool $allowEmptyValue = false,
        string $style = null,
        bool $explode = null,
        bool $allowReserved = false,
        ExampleMap $examples = null,
        ExtensionMap $extensions = null
    ) {
        $this->name = $name;
        $this->in = $in;
        $this->schema = $schema;
        $this->content = $content;
        $this->description = $description;
        $this->required = $required;
        $this->deprecated = $deprecated;
        $this->allowEmptyValue = $allowEmptyValue;
        $this->style = $style;
        // TODO: The defaults is based on other fields.
        $this->explode = (bool) $explode;
        $this->allowReserved = $allowReserved;
        $this->examples = $examples;
        $this->extensions = $extensions;
    }

    public function getIn(): string
    {
        return $this->in;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSchema(): SchemaAggregate
    {
        return $this->schema;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function hasSchema(): bool
    {
        return isset($this->schema);
    }

    public function hasStyle(): bool
    {
        return isset($this->style);
    }

    public function isAllowEmptyValue(): bool
    {
        return $this->allowEmptyValue;
    }

    public function isAllowReserved(): bool
    {
        return $this->allowReserved;
    }

    public function isExplode(): bool
    {
        return $this->explode;
    }

    public function isRequired(): bool
    {
        return $this->required === true;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'schema' => $this->hasSchema() ? $this->getSchema()->jsonSerialize() : null,
            'content' => $this->getNormalizedContent(),
            'description' => $this->getNormalizedDescription(),
            'required' => $this->isRequiredSet() ? $this->isRequired() : null,
            'deprecated' => $this->isDeprecated() ?: null,
            'allowEmptyValue' => $this->isAllowEmptyValue() ?: null,
            'style' => $this->hasStyle() ? $this->getStyle() : null,
            'explode' => $this->isExplode() ?: null,
            'allowReserved' => $this->isAllowReserved() ?: null,
            'examples' => $this->hasExamples() ? $this->getExamples()->jsonSerialize() : null,
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'name' => $this->getName(),
            'in' => $this->getIn(),
        ];
    }

    private function isRequiredSet(): bool
    {
        return isset($this->required);
    }
}
