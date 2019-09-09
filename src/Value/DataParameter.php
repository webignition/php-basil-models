<?php

namespace webignition\BasilModel\Value;

class DataParameter extends AbstractObjectValue implements ObjectValueInterface
{
    public function __construct(string $reference, string $objectProperty)
    {
        parent::__construct(ValueTypes::DATA_PARAMETER, $reference, ObjectNames::DATA, $objectProperty);
    }

    public function isActionable(): bool
    {
        return true;
    }
}
