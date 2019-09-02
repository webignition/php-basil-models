<?php

namespace webignition\BasilModel\Identifier;

interface ElementIdentifierInterface extends IdentifierInterface
{
    public function getPosition(): ?int;
    public function withPosition(int $position): ElementIdentifierInterface;
    public function getParentIdentifier(): ?ElementIdentifierInterface;
    public function withParentIdentifier(ElementIdentifierInterface $identifier): ElementIdentifierInterface;
}
