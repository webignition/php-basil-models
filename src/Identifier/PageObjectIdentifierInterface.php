<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ElementExpressionInterface;

interface PageObjectIdentifierInterface extends IdentifierInterface
{
    public function getPosition(): ?int;
    public function withPosition(int $position): PageObjectIdentifierInterface;
    public function getParentIdentifier(): ?PageObjectIdentifierInterface;
    public function withParentIdentifier(PageObjectIdentifierInterface $identifier): PageObjectIdentifierInterface;
    public function getElementExpression(): ElementExpressionInterface;
    public function getAttributeName(): ?string;
    public function withAttributeName(string $attributeName): PageObjectIdentifierInterface;
}
