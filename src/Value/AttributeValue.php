<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\AttributeIdentifierInterface;

class AttributeValue extends AbstractValue implements AttributeValueInterface
{
    private $identifier;

    public function __construct(AttributeIdentifierInterface $identifier)
    {
        parent::__construct(ValueTypes::ATTRIBUTE_IDENTIFIER);

        $this->identifier = $identifier;
    }

    public function getIdentifier(): AttributeIdentifierInterface
    {
        return $this->identifier;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function isActionable(): bool
    {
        return $this->identifier instanceof AttributeIdentifierInterface;
    }

    public function __toString(): string
    {
        return $this->identifier->__toString();
    }
}
