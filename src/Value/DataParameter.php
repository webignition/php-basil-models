<?php

namespace webignition\BasilModel\Value;

class DataParameter extends AbstractObjectValue implements ObjectValueInterface
{
    public function __construct(string $reference, string $objectProperty)
    {
        parent::__construct($reference, $objectProperty);
    }

    public function isActionable(): bool
    {
        return true;
    }
}
