<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\IdentifierInterface;

class ElementValue extends AbstractValue implements ElementValueInterface
{
    private $identifier;

    public function __construct(IdentifierInterface $identifier)
    {
        parent::__construct(ValueTypes::ELEMENT_IDENTIFIER);

        $this->identifier = $identifier;
    }

    public function getIdentifier(): IdentifierInterface
    {
        return $this->identifier;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function isActionable(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return $this->identifier->__toString();
    }
}
