<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects\Properties;

use Aweapi\Openapi\Objects\MediaTypes;

trait MediaTypeContent
{
    private $content;

    public function getContent(): MediaTypes
    {
        return $this->content;
    }
}
