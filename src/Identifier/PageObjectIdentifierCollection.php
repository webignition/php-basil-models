<?php

namespace webignition\BasilModel\Identifier;

class PageObjectIdentifierCollection extends AbstractIdentifierCollection implements IdentifierCollectionInterface
{
    protected function canBeAdded($identifier): bool
    {
        return $identifier instanceof PageObjectIdentifierInterface;
    }

    public function getIdentifier(string $name): ?IdentifierInterface
    {
        return $this->getIdentifierByName($name);
    }

    public function current(): PageObjectIdentifierInterface
    {
        return parent::current();
    }

    public function replace(
        PageObjectIdentifierInterface $old,
        PageObjectIdentifierInterface $new
    ): PageObjectIdentifierCollection {
        $identifiers = [];

        foreach ($this as $index => $identifier) {
            if ($identifier === $old) {
                $identifier = $new;
            }

            $parentIdentifier = $identifier->getParentIdentifier();
            if (null !== $parentIdentifier && $parentIdentifier === $old) {
                $identifier = $identifier->withParentIdentifier($new);
            }

            $identifiers[] = $identifier;
        }

        return new PageObjectIdentifierCollection($identifiers);
    }
}
