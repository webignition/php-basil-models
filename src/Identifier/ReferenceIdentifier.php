<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class ReferenceIdentifier extends AbstractIdentifier implements ReferenceIdentifierInterface
{
    private $value;


    public function __construct(string $type, ValueInterface $value, string $name = null)
    {
        parent::__construct($type, $name);

        $this->value = $value;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }

    /**
     * @param string $name
     *
     * @return IdentifierInterface|ReferenceIdentifierInterface
     */
    public function withName(string $name): IdentifierInterface
    {
        return parent::withName($name);
    }

    public function __toString(): string
    {
        if ($this->value instanceof LiteralValue) {
            return $this->value->getValue();
        }

        return $this->value->__toString();
    }
}
