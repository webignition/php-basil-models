<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ElementExpressionInterface;

interface ElementIdentifierInterface extends IdentifierInterface
{
    public function getPosition(): ?int;
    public function withPosition(int $position): ElementIdentifierInterface;
    public function getParentIdentifier(): ?ElementIdentifierInterface;
    public function withParentIdentifier(ElementIdentifierInterface $identifier): ElementIdentifierInterface;
    public function getElementExpression(): ElementExpressionInterface;
}
