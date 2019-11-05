<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class RequestBodiesBuilder implements Objects\RequestBodiesFactory
{
    private $requestBodies = [];

    public function addRequestBodies(iterable $requestBodies): self
    {
        foreach ($requestBodies as $name => $requestBody) {
            $this->setRequestBody($name, $requestBody);
        }

        return $this;
    }

    public function createRequestBodies(): Objects\RequestBodies
    {
        return new Objects\RequestBodies(
            array_map(
                static function (Objects\RequestBodyAggregateFactory $factory): Objects\RequestBodyAggregate {
                    return $factory->createRequestBodyAggregate();
                },
                $this->getRequestBodies()
            )
        );
    }

    public function setRequestBody(string $name, Objects\RequestBodyAggregateFactory $requestBody): self
    {
        $this->requestBodies[$name] = $requestBody;

        return $this;
    }

    private function getRequestBodies(): array
    {
        return $this->requestBodies;
    }
}
