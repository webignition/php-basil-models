<?php

namespace webignition\BasilModel\Value;

class AttributeReference extends AbstractReferenceValue implements ReferenceValueInterface
{
    public function __construct(string $reference, string $object, string $property)
    {
        parent::__construct(ValueTypes::ATTRIBUTE_PARAMETER, $reference, $object, $property);
    }
}
