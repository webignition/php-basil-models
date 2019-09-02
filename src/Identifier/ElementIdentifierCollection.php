<?php

namespace webignition\BasilModel\Identifier;

class ElementIdentifierCollection extends AbstractIdentifierCollection implements IdentifierCollectionInterface
{
    protected function canBeAdded($identifier): bool
    {
        return $identifier instanceof ElementIdentifierInterface;
    }

    public function getIdentifier(string $name): ?IdentifierInterface
    {
        return $this->getIdentifierByName($name);
    }

    public function current(): ElementIdentifierInterface
    {
        return parent::current();
    }
}
