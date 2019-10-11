<?php

declare(strict_types=1);

namespace Waspes\Objects\SecurityScheme;

use Waspes\Objects\ExtensionMap;
use Waspes\Objects\SecurityScheme;

final class OpenIdConnectSecurityScheme extends SecurityScheme
{
    private $openIdConnectUrl;

    public function __construct(
        string $openIdConnectUrl,
        string $description = null,
        ExtensionMap $extensions = null
    ) {
        parent::__construct(
            SecurityScheme::TYPE_OPEN_ID_CONNECT,
            $description,
            $extensions
        );
        $this->openIdConnectUrl = $openIdConnectUrl;
    }

    public function getOpenIdConnectUrl(): string
    {
        return $this->openIdConnectUrl;
    }

    protected function normalizeRequiredSchemeProperties(): array
    {
        return [
            'openIdConnectUrl' => $this->getOpenIdConnectUrl(),
        ];
    }
}
