<?php

namespace webignition\BasilModel\Value;

class LiteralValue implements LiteralValueInterface
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getType(): string
    {
        return ValueTypes::STRING;
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
