<?php

namespace webignition\BasilModel\Value;

class AttributeReference extends AbstractReferenceValue implements ReferenceValueInterface
{
    public function __construct(string $reference, string $property)
    {
        parent::__construct($reference, $property);
    }
}
