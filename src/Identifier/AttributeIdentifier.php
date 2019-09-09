<?php

namespace webignition\BasilModel\Identifier;

class AttributeIdentifier extends AbstractIdentifier implements AttributeIdentifierInterface
{
    private $elementIdentifier;
    private $attributeName = null;

    public function __construct(ElementIdentifierInterface $elementIdentifier, string $attributeName)
    {
        parent::__construct(IdentifierTypes::ATTRIBUTE);

        $this->elementIdentifier = $elementIdentifier;
        $this->attributeName = $attributeName;
    }

    public function getElementIdentifier(): ElementIdentifierInterface
    {
        return $this->elementIdentifier;
    }

    public function getAttributeName(): ?string
    {
        return $this->attributeName;
    }

    public function __toString(): string
    {
        $string = (string) $this->elementIdentifier;

        if ('' !== $this->attributeName) {
            $string .= '.' . $this->attributeName;
        }

        return $string;
    }
}
