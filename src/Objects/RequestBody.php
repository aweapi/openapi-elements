<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

final class RequestBody extends ValueObject implements RequestBodyAggregate
{
    use Properties\MediaTypeContent;
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;

    private $required;

    public function __construct(
        MediaTypes $content,
        string $description = null,
        bool $required = false,
        Extensions $extensions = null
    ) {
        $this->content = $content;
        $this->description = $description;
        $this->required = $required;
        $this->extensions = $extensions;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'description' => $this->getNormalizedDescription(),
            'required' => $this->isRequired() ?: null,
        ];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'content' => $this->getContent()->jsonSerialize() ?: self::emptyObject(),
        ];
    }
}
