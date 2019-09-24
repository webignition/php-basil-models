<?php

namespace webignition\BasilModel\Identifier;

class DomIdentifier extends AbstractIdentifier implements DomIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $elementLocator;
    private $position = null;
    private $attributeName = null;

    /**
     * @var DomIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(string $elementLocator)
    {
        $this->elementLocator = $elementLocator;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function withPosition(int $position): DomIdentifierInterface
    {
        $new = clone $this;
        $new->position = $position;

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

    public function getElementLocator(): string
    {
        return $this->elementLocator;
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
        $string = $this->elementLocator;

        if ($this->parentIdentifier instanceof DomIdentifierInterface) {
            $string = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $string;
        }

        $string = '"' . $string . '"';

        if (null !== $this->position && self::DEFAULT_POSITION !== $this->position) {
            $string .= ':' . $this->position;
        }

        if (null !== $this->attributeName && '' !== $this->attributeName) {
            $string .= '.' . $this->attributeName;
        }

        return $string;
    }
}
