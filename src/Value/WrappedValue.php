<?php

namespace webignition\BasilModel\Value;

class WrappedValue implements WrappedValueInterface
{
    private $wrappedValue;

    public function __construct(ValueInterface $value)
    {
        $this->wrappedValue = $value;
    }

    public function isEmpty(): bool
    {
        return $this->wrappedValue->isEmpty();
    }

    public function isActionable(): bool
    {
        return $this->wrappedValue->isActionable();
    }

    public function __toString(): string
    {
        return $this->wrappedValue->__toString();
    }

    public function getWrappedValue(): ValueInterface
    {
        return $this->wrappedValue;
    }
}
