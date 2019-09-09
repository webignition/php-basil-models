<?php

namespace webignition\BasilModel\Value;

abstract class AbstractReferenceValue implements ReferenceValueInterface
{
    private $reference;
    private $property;

    public function __construct(string $reference, string $property)
    {
        $this->reference = $reference;
        $this->property = $property;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function isEmpty(): bool
    {
        return '' === trim($this->reference);
    }

    public function isActionable(): bool
    {
        return false;
    }

    public function __toString(): string
    {
        return $this->reference;
    }
}
