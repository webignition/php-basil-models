<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\ElementIdentifierInterface;

class ElementValue implements ElementValueInterface
{
    private $identifier;

    public function __construct(ElementIdentifierInterface $identifier)
    {
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
        return true;
    }

    public function __toString(): string
    {
        return $this->identifier->__toString();
    }
}
