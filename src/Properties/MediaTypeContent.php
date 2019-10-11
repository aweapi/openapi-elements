<?php

declare(strict_types=1);

namespace Waspes\Objects\Properties;

use Waspes\Objects\MediaTypeMap;

trait MediaTypeContent
{
    private $content;

    public function getContent(): MediaTypeMap
    {
        return $this->content;
    }
}
