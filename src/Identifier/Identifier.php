<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class Identifier implements IdentifierInterface
{
    private $value;
    private $type = '';
    private $name;

    public function __construct(string $type, ValueInterface $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withName(string $name): IdentifierInterface
    {
        $new = clone $this;
        $new->name = $name;

        return $new;
    }

    public function __toString(): string
    {
        $value = $this->getValue();

        if ($value instanceof LiteralValue) {
            return $value->getValue();
        }

        return (string) $value;
    }
}
