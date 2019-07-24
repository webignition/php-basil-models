<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\ValueInterface;

class ElementIdentifier extends AbstractIdentifier implements ElementIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $value;
    private $position = 1;

    /**
     * @var ElementIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(LiteralValueInterface $value, int $position = null, string $name = null)
    {
        parent::__construct(IdentifierTypes::ELEMENT_SELECTOR, $name);

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

    public function getParentIdentifier(): ?ElementIdentifierInterface
    {
        return $this->parentIdentifier;
    }

    public function withParentIdentifier(ElementIdentifierInterface $parentIdentifier): ElementIdentifierInterface
    {
        $new = clone $this;
        $new->parentIdentifier = $parentIdentifier;

        return $new;
    }

    /**
     * @param string $name
     *
     * @return IdentifierInterface|ElementIdentifierInterface
     */
    public function withName(string $name): IdentifierInterface
    {
        return parent::withName($name);
    }

    public function __toString(): string
    {
        $string = $this->value->getValue();

        if ($this->parentIdentifier instanceof ElementIdentifierInterface) {
            $string = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $string;
        }

        $string = '"' . $string . '"';

        if (self::DEFAULT_POSITION !== $this->position) {
            $string .= ':' . $this->position;
        }

        return $string;
    }
}
