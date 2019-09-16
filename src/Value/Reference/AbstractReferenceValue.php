<?php

namespace webignition\BasilModel\Value\Reference;

abstract class AbstractReferenceValue implements ReferenceValueInterface
{
    private $reference;
    private $property;
    private $default = '';

    public function __construct(string $reference, string $property, string $default = '')
    {
        $this->reference = $reference;
        $this->property = $property;
        $this->default = $default;
    }

    public function getDefault(): string
    {
        return $this->default;
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function __toString(): string
    {
        return $this->reference;
    }
}
