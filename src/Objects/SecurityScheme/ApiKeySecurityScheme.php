<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\SecurityScheme;

use Aweapi\Openapi\Extensions;
use Aweapi\Openapi\Objects\SecurityScheme;

final class ApiKeySecurityScheme extends SecurityScheme
{
    private $in;

    private $name;

    public function __construct(
        string $name,
        string $in,
        string $description = null,
        Extensions $extensions = null
    ) {
        parent::__construct(
            SecurityScheme::TYPE_API_KEY,
            $description,
            $extensions
        );
        $this->name = $name;
        $this->in = $in;
    }

    public function getIn(): string
    {
        return $this->in;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function normalizeRequiredSchemeProperties(): array
    {
        return [
            'name' => $this->getName(),
            'in' => $this->getIn(),
        ];
    }
}
