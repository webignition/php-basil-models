<?php

namespace webignition\BasilModel\Exception;

use webignition\BasilModel\Value\ValueInterface;

class InvalidAssertionExaminedValueException extends AbstractInvalidAssertionValueException
{
    public function __construct(ValueInterface $value)
    {
        parent::__construct('Invalid assertion examined value "' . (string) $value . '"', $value);
    }
}
