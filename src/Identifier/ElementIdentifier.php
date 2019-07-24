<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\LiteralValueInterface;

class ElementIdentifier extends Identifier implements ElementIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $position = 1;

    /**
     * @var ElementIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(LiteralValueInterface $value, int $position = null, string $name = null)
    {
        parent::__construct(IdentifierTypes::ELEMENT_SELECTOR, $value, $name);

        $position = $position ?? self::DEFAULT_POSITION;

        $this->position = $position;
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

    public function __toString(): string
    {
        $string = parent::__toString();

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
