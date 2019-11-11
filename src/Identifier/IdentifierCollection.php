<?php

declare(strict_types=1);

namespace webignition\BasilModel\Identifier;

class IdentifierCollection extends AbstractIdentifierCollection implements IdentifierCollectionInterface
{
    protected function canBeAdded($identifier): bool
    {
        return $identifier instanceof IdentifierInterface;
    }

    public function getIdentifier(string $name): ?IdentifierInterface
    {
        return $this->getIdentifierByName($name);
    }

    public function current(): IdentifierInterface
    {
        return parent::current();
    }
}
