<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\PageObjectIdentifierInterface;

class PageObjectValue implements PageObjectValueInterface
{
    private $identifier;

    public function __construct(PageObjectIdentifierInterface $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): PageObjectIdentifierInterface
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
