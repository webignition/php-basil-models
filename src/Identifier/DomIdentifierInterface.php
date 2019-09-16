<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ElementExpressionInterface;

interface DomIdentifierInterface extends IdentifierInterface
{
    public function getPosition(): ?int;
    public function withPosition(int $position): DomIdentifierInterface;
    public function getParentIdentifier(): ?DomIdentifierInterface;
    public function withParentIdentifier(DomIdentifierInterface $identifier): DomIdentifierInterface;
    public function getElementExpression(): ElementExpressionInterface;
    public function getAttributeName(): ?string;
    public function withAttributeName(string $attributeName): DomIdentifierInterface;
}
