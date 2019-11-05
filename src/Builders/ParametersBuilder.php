<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ParametersBuilder implements Objects\ParametersFactory
{
    private $parameters = [];

    public function addParameters(iterable $parameters): self
    {
        foreach ($parameters as $name => $parameter) {
            $this->setParameter($name, $parameter);
        }

        return $this;
    }

    public function createParameters(): Objects\Parameters
    {
        return new Objects\Parameters(
            array_map(
                static function (Objects\ParameterAggregateFactory $factory): Objects\ParameterAggregate {
                    return $factory->createParameterAggregate();
                },
                $this->getParameters()
            )
        );
    }

    public function setParameter(string $name, Objects\ParameterAggregateFactory $parameter): self
    {
        $this->parameters[$name] = $parameter;

        return $this;
    }

    private function getParameters(): array
    {
        return $this->parameters;
    }
}
