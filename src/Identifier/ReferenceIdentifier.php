<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ValueInterface;

class ReferenceIdentifier extends AbstractIdentifier implements ReferenceIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $value;
    private $position = 1;

    public function __construct(string $type, ValueInterface $value, string $name = null)
    {
        parent::__construct($type, $name);

        $position = $position ?? self::DEFAULT_POSITION;

        $this->value = $value;
        $this->position = $position;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param string $name
     *
     * @return IdentifierInterface|ReferenceIdentifierInterface
     */
    public function withName(string $name): IdentifierInterface
    {
        return parent::withName($name);
    }

    public function __toString(): string
    {
        return $this->value->__toString();
    }
}
