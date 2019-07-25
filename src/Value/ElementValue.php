<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\IdentifierInterface;

class ElementValue extends AbstractValue implements ElementValueInterface
{
    private $identifier;

    public function __construct(ElementIdentifier $identifier)
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
        return $this->identifier instanceof ElementIdentifier;
    }

    public function __toString(): string
    {
        return $this->identifier->__toString();
    }
}
