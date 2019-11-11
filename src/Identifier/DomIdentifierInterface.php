<?php

declare(strict_types=1);

namespace webignition\BasilModel\Identifier;

use webignition\DomElementLocator\ElementLocatorInterface;

interface DomIdentifierInterface extends IdentifierInterface, ElementLocatorInterface
{
    public function getParentIdentifier(): ?DomIdentifierInterface;
    public function withParentIdentifier(DomIdentifierInterface $identifier): DomIdentifierInterface;
    public function getAttributeName(): ?string;
    public function withAttributeName(string $attributeName): DomIdentifierInterface;
}
