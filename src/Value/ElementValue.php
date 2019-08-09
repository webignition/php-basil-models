<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\ElementIdentifierInterface;

class ElementValue extends AbstractValue implements ElementValueInterface
{
    private $identifier;

    public function __construct(ElementIdentifierInterface $identifier)
    {
        parent::__construct(ValueTypes::ELEMENT_IDENTIFIER);

        $this->identifier = $identifier;
    }

    public function getIdentifier(): ElementIdentifierInterface
    {
        return $this->identifier;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function isActionable(): bool
    {
        return $this->identifier instanceof ElementIdentifierInterface;
    }

    public function __toString(): string
    {
        return $this->identifier->__toString();
    }
}
