<?php

declare(strict_types=1);

namespace webignition\BasilModel\Identifier;

class DomIdentifierCollection extends AbstractIdentifierCollection implements IdentifierCollectionInterface
{
    protected function canBeAdded($identifier): bool
    {
        return $identifier instanceof DomIdentifierInterface;
    }

    public function getIdentifier(string $name): ?IdentifierInterface
    {
        return $this->getIdentifierByName($name);
    }

    public function current(): DomIdentifierInterface
    {
        return parent::current();
    }

    public function replace(
        DomIdentifierInterface $old,
        DomIdentifierInterface $new
    ): DomIdentifierCollection {
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

        return new DomIdentifierCollection($identifiers);
    }
}
