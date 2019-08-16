<?php

namespace webignition\BasilModel\Value;

class ObjectValue extends AbstractValue implements ObjectValueInterface
{
    private $reference;
    private $objectName;
    private $objectProperty;

    public function __construct(string $type, string $reference, string $objectName, string $objectProperty)
    {
        parent::__construct($type);

        $this->reference = $reference;
        $this->objectName = $objectName;
        $this->objectProperty = $objectProperty;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getObjectName(): string
    {
        return $this->objectName;
    }

    public function getObjectProperty(): string
    {
        return $this->objectProperty;
    }

    public function isEmpty(): bool
    {
        return '' === trim($this->reference);
    }

    public function isActionable(): bool
    {
        $nonActionableTypes = [
            ValueTypes::PAGE_ELEMENT_REFERENCE,
            ValueTypes::ATTRIBUTE_PARAMETER,
            ValueTypes::ELEMENT_PARAMETER,
        ];

        return !in_array($this->getType(), $nonActionableTypes);
    }

    public function __toString(): string
    {
        return $this->reference;
    }
}
