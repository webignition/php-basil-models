<?php

namespace webignition\BasilModel\Value;

abstract class AbstractReferenceValue extends AbstractValue implements ReferenceValueInterface
{
    private $reference;
    private $object;
    private $property;

    public function __construct(string $type, string $reference, string $object, string $property)
    {
        parent::__construct($type);

        $this->reference = $reference;
        $this->object = $object;
        $this->property = $property;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getObject(): string
    {
        return $this->object;
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
