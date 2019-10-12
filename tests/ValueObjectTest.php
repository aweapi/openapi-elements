<?php

declare(strict_types=1);

namespace Aweapi\Tests\Openapi;

use Aweapi\Openapi\ValueObject;

final class ValueObjectTest extends TestCase
{
    /**
     * @test
     */
    public function alwaysReturnsRequiredProperties(): void
    {
        $object = $this->createAbstractValueObject(null);
        self::assertSame('{"requiredField":{}}', json_encode($object));
    }

    /**
     * @test
     */
    public function isCreatedWithOptionalProperties(): void
    {
        $object = $this->createAbstractValueObject('foo', 'bar');
        self::assertJsonObject([
            'requiredField' => 'foo',
            'optionalField' => 'bar',
        ], $object);
    }

    /**
     * @test
     */
    public function isCreatedWithoutOptionalProperties(): void
    {
        $object = $this->createAbstractValueObject('foo');
        self::assertJsonObject([
            'requiredField' => 'foo',
        ], $object);
    }

    private function createAbstractValueObject(?string $requiredFieldValue, string $optionalFieldValue = null): ValueObject
    {
        return new class($requiredFieldValue, $optionalFieldValue) extends ValueObject {
            private $requiredFieldValue;

            private $optionalFieldValue;

            public function __construct(?string $requiredFieldValue, string $optionalFieldValue = null)
            {
                $this->requiredFieldValue = $requiredFieldValue;
                $this->optionalFieldValue = $optionalFieldValue;
            }

            protected function normalizeRequiredProperties(): array
            {
                return [
                    'requiredField' => $this->requiredFieldValue ?: ValueObject::emptyObject(),
                ];
            }

            protected function normalizeOptionalProperties(): array
            {
                return [
                    'optionalField' => $this->optionalFieldValue,
                ];
            }
        };
    }
}
