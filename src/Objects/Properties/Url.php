<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

trait Url
{
    private $url;

    public function getUrl(): string
    {
        return $this->url;
    }
}
