<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\LiteralValue;

class AttributeIdentifier extends Identifier implements AttributeIdentifierInterface
{
    private $identifier;
    private $attributeName = null;

    public function __construct(ElementIdentifierInterface $identifier, string $attributeName)
    {
        parent::__construct(IdentifierTypes::ATTRIBUTE, LiteralValue::createStringValue($attributeName));

        $this->identifier = $identifier;
        $this->attributeName = $attributeName;
    }

    public function getElementIdentifier(): ?ElementIdentifierInterface
    {
        return $this->identifier;
    }

    public function getAttributeName(): ?string
    {
        return $this->attributeName;
    }

    public function __toString(): string
    {
        $string = (string) $this->identifier;

        if ('' !== $this->attributeName) {
            $string .= '.' . $this->attributeName;
        }

        return $string;
    }
}
