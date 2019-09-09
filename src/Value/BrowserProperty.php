<?php

namespace webignition\BasilModel\Value;

class BrowserProperty extends AbstractObjectValue implements ObjectValueInterface
{
    public function __construct(string $reference, string $objectProperty)
    {
        parent::__construct(ValueTypes::BROWSER_OBJECT_PROPERTY, $reference, ObjectNames::BROWSER, $objectProperty);
    }

    public function isActionable(): bool
    {
        return true;
    }
}
