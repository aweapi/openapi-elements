<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

use Waspes\Objects\MediaTypes;

trait MediaTypeContent
{
    private $content;

    public function getContent(): MediaTypes
    {
        return $this->content;
    }
}
