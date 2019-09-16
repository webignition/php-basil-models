<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExaminedValueException;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\DomIdentifierValueInterface;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\Value\WrappedValueInterface;

interface AssertableExaminedValueInterface extends ValueInterface, WrappedValueInterface
{
    /**
     * @return ObjectValueInterface|DomIdentifierValueInterface
     *
     * @throws InvalidAssertableExaminedValueException
     */
    public function getExaminedValue();
}
