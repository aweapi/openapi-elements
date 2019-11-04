<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class ServerVariablesBuilder implements Objects\ServerVariablesFactory
{
    private $variables = [];

    public function addVariables(iterable $variables): self
    {
        foreach ($variables as $key => $variable) {
            $this->setVariable($key, $variable);
        }

        return $this;
    }

    public function createServerVariables(): Objects\ServerVariables
    {
        return new Objects\ServerVariables(
            array_map(
                static function (Objects\ServerVariableFactory $factory): Objects\ServerVariable {
                    return $factory->createServerVariable();
                },
                $this->getVariables()
            )
        );
    }

    public function setVariable(string $key, Objects\ServerVariableFactory $variable): self
    {
        $this->variables[$key] = $variable;

        return $this;
    }

    private function getVariables(): array
    {
        return $this->variables;
    }
}
