<?php

namespace webignition\BasilModel\Value;

class PageProperty extends AbstractObjectValue implements ObjectValueInterface
{
    public function __construct(string $reference, string $objectProperty)
    {
        parent::__construct(ValueTypes::PAGE_OBJECT_PROPERTY, $reference, ObjectNames::PAGE, $objectProperty);
    }

    public function isActionable(): bool
    {
        return true;
    }
}
