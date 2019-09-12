<?php

namespace webignition\BasilModel\Exception;

use webignition\BasilModel\Value\ValueInterface;

class InvalidAssertableExaminedValueException extends AbstractInvalidAssertionValueException
{
    public function __construct(ValueInterface $value)
    {
        parent::__construct('Invalid assertable examined value "' . (string) $value . '"', $value);
    }
}
