<?php

namespace webignition\BasilModel\Value;

class LiteralValue extends AbstractValue implements LiteralValueInterface
{
    private $value;

    public function __construct(string $value)
    {
        parent::__construct(ValueTypes::STRING);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return '' === $this->value;
    }

    public function isActionable(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return '"' . $this->value . '"';
    }
}
