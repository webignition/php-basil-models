<?php

namespace webignition\BasilModel\Exception;

use webignition\BasilModel\Value\ValueInterface;

class InvalidAssertableExpectedValueException extends AbstractInvalidAssertionValueException
{
    public function __construct(ValueInterface $value)
    {
        parent::__construct('Invalid assertable expected value "' . (string) $value . '"', $value);
    }
}
