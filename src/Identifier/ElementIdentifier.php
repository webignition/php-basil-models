<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ElementExpressionInterface;

class ElementIdentifier extends AbstractIdentifier implements ElementIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $elementExpression;
    private $position = null;

    /**
     * @var ElementIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(ElementExpressionInterface $elementExpression, ?int $position = null)
    {
        $this->elementExpression = $elementExpression;
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

    public function getElementExpression(): ElementExpressionInterface
    {
        return $this->elementExpression;
    }

    public function __toString(): string
    {
        $string = $this->elementExpression->getExpression();

        if ($this->parentIdentifier instanceof ElementIdentifierInterface) {
            $string = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $string;
        }

        $string = '"' . $string . '"';

        if (null !== $this->position && self::DEFAULT_POSITION !== $this->position) {
            $string .= ':' . $this->position;
        }

        return $string;
    }
}
