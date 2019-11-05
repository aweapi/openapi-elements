<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class CallbackRequestBuilder implements Objects\CallbackRequestFactory
{
    use Properties\OptionalExtensions;

    private $items = [];

    public function addItems(iterable $items): self
    {
        foreach ($items as $expression => $path) {
            $this->setItem($expression, $path);
        }

        return $this;
    }

    public function createCallbackRequest(): Objects\CallbackRequest
    {
        return new Objects\CallbackRequest(
            array_map(
                static function (Objects\PathFactory $factory): Objects\Path {
                    return $factory->createPath();
                },
                $this->getItems()
            ),
            $this->getExtensions()
        );
    }

    public function setItem(string $expression, Objects\PathFactory $path): self
    {
        $this->items[$expression] = $path;

        return $this;
    }

    private function getItems(): array
    {
        return $this->items;
    }
}
