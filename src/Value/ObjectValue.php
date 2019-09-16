<?php

namespace webignition\BasilModel\Value;

class ObjectValue implements ObjectValueInterface
{
    private $type;
    private $reference;
    private $property;
    private $default;

    public function __construct(string $type, string $reference, string $property, string $default = '')
    {
        $this->type = $type;
        $this->reference = $reference;
        $this->property = $property;
        $this->default = $default;
    }


    public function getType(): string
    {
        return $this->type;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getDefault(): string
    {
        return $this->default;
    }

    public function isActionable(): bool
    {
        return in_array($this->type, ObjectValueType::ACTIONABLE);
    }

    public function isEmpty(): bool
    {
        return '' === $this->reference;
    }

    public function __toString(): string
    {
        return $this->reference;
    }
}
