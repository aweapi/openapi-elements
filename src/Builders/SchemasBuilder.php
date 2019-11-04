<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Builders;

use Aweapi\Openapi\Objects;

final class SchemasBuilder implements Objects\SchemasFactory
{
    private $schemas = [];

    public function addSchemas(iterable $schemas): self
    {
        foreach ($schemas as $key => $schema) {
            $this->setSchema($key, $schema);
        }

        return $this;
    }

    public function createSchemas(): Objects\Schemas
    {
        return new Objects\Schemas(
            array_map(
                static function (Objects\SchemaFactory $factory): Objects\Schema {
                    return $factory->createSchema();
                },
                $this->getSchemas()
            )
        );
    }

    public function setSchema(string $key, Objects\SchemaFactory $schema): self
    {
        $this->schemas[$key] = $schema;

        return $this;
    }

    private function getSchemas(): array
    {
        return $this->schemas;
    }
}
