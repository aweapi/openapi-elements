<?php

declare(strict_types=1);

namespace Waspes\Objects\SecurityScheme;

use Waspes\Objects\Extensions;
use Waspes\Objects\OAuthFlows;
use Waspes\Objects\SecurityScheme;

final class OAuth2SecurityScheme extends SecurityScheme
{
    private $flows;

    public function __construct(
        OAuthFlows $flows,
        string $description = null,
        Extensions $extensions = null
    ) {
        parent::__construct(
            SecurityScheme::TYPE_OAUTH2,
            $description,
            $extensions
        );
        $this->flows = $flows;
    }

    public function getFlows(): OAuthFlows
    {
        return $this->flows;
    }

    protected function normalizeRequiredSchemeProperties(): array
    {
        return [
            'flows' => $this->getFlows()->jsonSerialize(),
        ];
    }
}
