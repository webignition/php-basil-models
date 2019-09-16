<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ElementExpressionInterface;

class PageObjectIdentifier extends AbstractIdentifier implements PageObjectIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $elementExpression;
    private $position = null;
    private $attributeName = null;

    /**
     * @var PageObjectIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(ElementExpressionInterface $elementExpression)
    {
        $this->elementExpression = $elementExpression;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function withPosition(int $position): PageObjectIdentifierInterface
    {
        $new = clone $this;
        $new->position = $position;

        return $new;
    }

    public function getParentIdentifier(): ?PageObjectIdentifierInterface
    {
        return $this->parentIdentifier;
    }

    public function withParentIdentifier(PageObjectIdentifierInterface $parentIdentifier): PageObjectIdentifierInterface
    {
        $new = clone $this;
        $new->parentIdentifier = $parentIdentifier;

        return $new;
    }

    public function getElementExpression(): ElementExpressionInterface
    {
        return $this->elementExpression;
    }

    public function getAttributeName(): ?string
    {
        return $this->attributeName;
    }

    public function withAttributeName(string $attributeName): PageObjectIdentifierInterface
    {
        $new = clone $this;
        $new->attributeName = $attributeName;

        return $new;
    }

    public function __toString(): string
    {
        $string = $this->elementExpression->getExpression();

        if ($this->parentIdentifier instanceof PageObjectIdentifierInterface) {
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
