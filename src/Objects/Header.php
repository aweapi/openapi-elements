<?php

declare(strict_types=1);

namespace Aweapi\Openapi\Objects;

use Aweapi\Openapi\Extensions;

final class Header extends Parameter implements HeaderAggregate
{
    public function __construct(
        SchemaAggregate $schema = null,
        MediaTypes $content = null,
        string $description = null,
        bool $required = null,
        bool $deprecated = false,
        bool $allowEmptyValue = false,
        string $style = null,
        bool $explode = null,
        bool $allowReserved = false,
        Examples $examples = null,
        Extensions $extensions = null
    ) {
        parent::__construct(
            // The name MUST not be used.
            '',
            'header',
            $schema,
            $content,
            $description,
            $required,
            $deprecated,
            $allowEmptyValue,
            $style,
            $explode,
            $allowReserved,
            $examples,
            $extensions
        );
    }

    protected function normalizeRequiredProperties(): array
    {
        $fields = parent::normalizeRequiredProperties();
        unset(
            // The field `name` MUST NOT be specified, it is given in the corresponding headers map.
            $fields['name'],
            // The field `in` MUST NOT be specified, it is implicitly in `header`.
            $fields['in']
        );

        return $fields;
    }
}
