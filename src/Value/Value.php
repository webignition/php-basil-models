<?php

namespace webignition\BasilModel\Value;

class Value implements ValueInterface
{
    private $type;
    private $value;

    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return ValueTypes::STRING === $this->type
            ? '"' . $this->value . '"'
            : $this->value;
    }
}
