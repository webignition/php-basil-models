<?php

namespace webignition\BasilModel\Identifier;

class DomIdentifier implements DomIdentifierInterface
{
    use IdentifierNameTrait;

    const DEFAULT_POSITION = 1;

    private $locator;
    private $ordinalPosition = null;
    private $attributeName = null;

    /**
     * @var DomIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(string $elementLocator)
    {
        $this->locator = $elementLocator;
    }

    public function getOrdinalPosition(): ?int
    {
        return $this->ordinalPosition;
    }

    public function withOrdinalPosition(int $ordinalPosition): DomIdentifierInterface
    {
        $new = clone $this;
        $new->ordinalPosition = $ordinalPosition;

        return $new;
    }

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

    public function getLocator(): string
    {
        return $this->locator;
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
        $string = $this->locator;

        if ($this->parentIdentifier instanceof DomIdentifierInterface) {
            $string = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $string;
        }

        $string = '"' . $string . '"';

        if (null !== $this->ordinalPosition && self::DEFAULT_POSITION !== $this->ordinalPosition) {
            $string .= ':' . $this->ordinalPosition;
        }

        if (null !== $this->attributeName && '' !== $this->attributeName) {
            $string .= '.' . $this->attributeName;
        }

        return $string;
    }
}
