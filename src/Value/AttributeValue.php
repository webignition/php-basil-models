<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\AttributeIdentifierInterface;

class AttributeValue implements AttributeValueInterface
{
    private $identifier;

    public function __construct(AttributeIdentifierInterface $identifier)
    {
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
        return true;
    }

    public function __toString(): string
    {
        return $this->identifier->__toString();
    }
}
