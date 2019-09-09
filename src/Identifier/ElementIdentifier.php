<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\LiteralValueInterface;

class ElementIdentifier extends ReferenceIdentifier implements ElementIdentifierInterface
{
    private $position = null;

    /**
     * @var ElementIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(LiteralValueInterface $value, ?int $position = null)
    {
        parent::__construct(IdentifierTypes::ELEMENT_SELECTOR, $value);

        $this->position = $position;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function withPosition(int $position): ElementIdentifierInterface
    {
        $new = clone $this;
        $new->position = $position;

        return $new;
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

        if (null !== $this->position) {
            $string .= ':' . $this->position;
        }

        return $string;
    }
}
