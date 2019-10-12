<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class Example extends ValueObject implements ExampleAggregate
{
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;
    use Properties\OptionalSummary;

    private $externalValue;

    private $value;

    /**
     * @param mixed $value
     */
    public function __construct(
        string $summary = null,
        string $description = null,
        $value = null,
        string $externalValue = null,
        Extensions $extensions = null
    ) {
        $this->summary = $summary;
        $this->description = $description;
        $this->value = $value;
        $this->externalValue = $externalValue;
        $this->extensions = $extensions;
    }

    public function getExternalValue(): string
    {
        return $this->externalValue;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function hasExternalValue(): bool
    {
        return isset($this->externalValue);
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'summary' => $this->getNormalizedSummary(),
            'description' => $this->getNormalizedDescription(),
            'value' => $this->getValue(),
            'externalValue' => $this->hasExternalValue() ? $this->getExternalValue() : null,
        ];
    }
}
