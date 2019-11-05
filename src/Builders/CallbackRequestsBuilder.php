<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class CallbackRequestsBuilder implements Objects\CallbackRequestsFactory
{
    private $callbacks = [];

    public function addCallbacks(iterable $callbacks): self
    {
        foreach ($callbacks as $name => $callback) {
            $this->setCallback($name, $callback);
        }

        return $this;
    }

    public function createCallbackRequests(): Objects\CallbackRequests
    {
        return new Objects\CallbackRequests(
            array_map(
                static function (Objects\CallbackRequestFactory $factory): Objects\CallbackRequest {
                    return $factory->createCallbackRequest();
                },
                $this->getCallbacks()
            )
        );
    }

    public function setCallback(string $name, Objects\CallbackRequestFactory $callback): self
    {
        $this->callbacks[$name] = $callback;

        return $this;
    }

    private function getCallbacks(): array
    {
        return $this->callbacks;
    }
}
