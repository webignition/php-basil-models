<?php

namespace webignition\BasilModel\Identifier;

use webignition\DomElementLocator\ElementLocator;

class DomIdentifier extends ElementLocator implements DomIdentifierInterface
{
    use IdentifierNameTrait;

    private const DEFAULT_POSITION = 1;

    private $attributeName = null;

    /**
     * @var DomIdentifierInterface
     */
    private $parentIdentifier;

    public function getParentIdentifier(): ?DomIdentifierInterface
    {
        return $this->parentIdentifier;
    }

    public function withParentIdentifier(DomIdentifierInterface $parentIdentifier): DomIdentifierInterface
    {
        $new = clone $this;
        $new->parentIdentifier = $parentIdentifier;

        return $new;
    }

    public function getAttributeName(): ?string
    {
        return $this->attributeName;
    }

    public function withAttributeName(string $attributeName): DomIdentifierInterface
    {
        $new = clone $this;
        $new->attributeName = $attributeName;

        return $new;
    }

    public function __toString(): string
    {
        $string = $this->getLocator();

        if ($this->parentIdentifier instanceof DomIdentifierInterface) {
            $string = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $string;
        }

        $string = '"' . $string . '"';

        $ordinalPosition = $this->getOrdinalPosition();

        if (null !== $ordinalPosition && self::DEFAULT_POSITION !== $ordinalPosition) {
            $string .= ':' . $ordinalPosition;
        }

        if (null !== $this->attributeName && '' !== $this->attributeName) {
            $string .= '.' . $this->attributeName;
        }

        return $string;
    }
}
