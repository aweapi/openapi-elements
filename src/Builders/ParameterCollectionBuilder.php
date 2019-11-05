<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ParameterCollectionBuilder implements Objects\ParameterCollectionFactory
{
    private $parameters = [];

    public function addParameters(Objects\ParameterFactory ...$parameters): self
    {
        foreach ($parameters as $parameter) {
            $this->parameters[] = $parameter;
        }

        return $this;
    }

    public function createParameterCollection(): Objects\ParameterCollection
    {
        return new Objects\ParameterCollection(
            array_map(
                static function (Objects\ParameterFactory $factory): Objects\Parameter {
                    return $factory->createParameter();
                },
                $this->getParameters()
            )
        );
    }

    private function getParameters(): array
    {
        return $this->parameters;
    }
}
