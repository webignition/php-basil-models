<?php

namespace webignition\BasilModel\Identifier;

interface AttributeIdentifierInterface extends IdentifierInterface
{
    public function getElementIdentifier(): ?ElementIdentifierInterface;
    public function getAttributeName(): ?string;
}
