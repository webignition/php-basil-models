<?php

namespace webignition\BasilModel\Identifier;

class IdentifierCollection implements IdentifierCollectionInterface
{
    /**
     * @var IdentifierInterface[]
     */
    private $identifiers;

    /**
     * @param IdentifierInterface[] $identifiers
     */
    public function __construct(array $identifiers = [])
    {
        foreach ($identifiers as $identifier) {
            if ($identifier instanceof IdentifierInterface) {
                $name = $identifier->getName();

                if (is_string($name)) {
                    $this->identifiers[$name] = $identifier;
                }
            }
        }
    }

    public function getIdentifier(string $name): ?IdentifierInterface
    {
        return $this->identifiers[$name] ?? null;
    }
}
