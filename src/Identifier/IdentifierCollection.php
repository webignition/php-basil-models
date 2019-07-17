<?php

namespace webignition\BasilModel\Identifier;

class IdentifierCollection implements IdentifierCollectionInterface, \Iterator
{
    /**
     * @var IdentifierInterface[]
     */
    private $identifiers = [];

    private $index = [];

    private $iteratorPosition = 0;

    /**
     * @param IdentifierInterface[] $identifiers
     */
    public function __construct(array $identifiers = [])
    {
        foreach ($identifiers as $identifier) {
            if ($identifier instanceof IdentifierInterface) {
                $name = $identifier->getName();

                if (is_string($name)) {
                    $position = count($this->identifiers);

                    $this->identifiers[] = $identifier;
                    $this->index[$name] = $position;
                }
            }
        }
    }

    public function getIdentifier(string $name): ?IdentifierInterface
    {
        $position = $this->index[$name] ?? null;
        if (null === $position) {
            return null;
        }

        return $this->identifiers[$position] ?? null;
    }

    // Iterator methods

    public function rewind()
    {
        $this->iteratorPosition = 0;
    }

    public function current(): IdentifierInterface
    {
        return $this->identifiers[$this->iteratorPosition];
    }

    public function key(): int
    {
        return $this->iteratorPosition;
    }

    public function next()
    {
        ++$this->iteratorPosition;
    }

    public function valid(): bool
    {
        return isset($this->identifiers[$this->iteratorPosition]);
    }
}
