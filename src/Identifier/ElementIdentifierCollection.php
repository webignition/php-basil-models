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

    public function replace(
        ElementIdentifierInterface $old,
        ElementIdentifierInterface $new
    ): ElementIdentifierCollection {
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

        return new ElementIdentifierCollection($identifiers);
    }
}
