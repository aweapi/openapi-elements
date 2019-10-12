<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\ValueObject;

abstract class SecurityScheme extends ValueObject implements SecuritySchemeAggregate
{
    use Properties\OptionalDescription;
    use Properties\OptionalExtensions;

    public const TYPE_API_KEY = 'apiKey';

    public const TYPE_HTTP = 'http';

    public const TYPE_OAUTH2 = 'oauth2';

    public const TYPE_OPEN_ID_CONNECT = 'openIdConnect';

    private $type;

    public function __construct(
        string $type,
        string $description = null,
        Extensions $extensions = null
    ) {
        $this->type = $type;
        $this->description = $description;
        $this->extensions = $extensions;
    }

    public function getType(): string
    {
        return $this->type;
    }

    final public function jsonSerialize(): ?array
    {
        return $this->extendedProperties(parent::jsonSerialize());
    }

    protected function normalizeOptionalProperties(): array
    {
        return [
            'description' => $this->getNormalizedDescription(),
        ] + $this->normalizeOptionalSchemeProperties();
    }

    protected function normalizeOptionalSchemeProperties(): array
    {
        return [];
    }

    protected function normalizeRequiredProperties(): array
    {
        return [
            'type' => $this->getType(),
        ] + $this->normalizeRequiredSchemeProperties();
    }

    abstract protected function normalizeRequiredSchemeProperties(): array;
}
