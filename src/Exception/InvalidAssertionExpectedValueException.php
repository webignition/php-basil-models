<?php

namespace webignition\BasilModel\Exception;

use webignition\BasilModel\Value\ValueInterface;

class InvalidAssertionExpectedValueException extends AbstractInvalidAssertionValueException
{
    public function __construct(ValueInterface $value)
    {
        parent::__construct('Invalid assertion expected value "' . (string) $value . '"', $value);
    }
}
