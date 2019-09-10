<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\ValueInterface;

class ReferenceIdentifier extends AbstractIdentifier implements ReferenceIdentifierInterface
{
    private $type;
    private $value;

    private function __construct(string $type, ReferenceValueInterface $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public static function createPageElementReferenceIdentifier(
        ReferenceValueInterface $value
    ): ReferenceIdentifierInterface {
        return new ReferenceIdentifier(ReferenceIdentifierTypes::PAGE_ELEMENT_REFERENCE, $value);
    }

    public static function createElementReferenceIdentifier(
        ReferenceValueInterface $value
    ): ReferenceIdentifierInterface {
        return new ReferenceIdentifier(ReferenceIdentifierTypes::ELEMENT_REFERENCE, $value);
    }

    public static function createAttributeReferenceIdentifier(
        ReferenceValueInterface $value
    ): ReferenceIdentifierInterface {
        return new ReferenceIdentifier(ReferenceIdentifierTypes::ATTRIBUTE_REFERENCE, $value);
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
