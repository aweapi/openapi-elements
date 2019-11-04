<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ExampleBuilder implements Objects\ExampleFactory
{
    use Properties\OptionalExtensions;

    private $description;

    private $externalValue;

    private $summary;

    private $value;

    public function createExample(): Objects\Example
    {
        return new Objects\Example(
            $this->getSummary(),
            $this->getDescription(),
            $this->getValue(),
            $this->getExternalValue(),
            $this->getExtensions()
        );
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setExternalValue(string $externalValue): self
    {
        $this->externalValue = $externalValue;

        return $this;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    private function getDescription(): ?string
    {
        return $this->description;
    }

    private function getExternalValue(): ?string
    {
        return $this->externalValue;
    }

    private function getSummary(): ?string
    {
        return $this->summary;
    }

    private function getValue()
    {
        return $this->value;
    }
}
