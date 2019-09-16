<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExaminedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\Value\WrappedValueInterface;

interface AssertableExaminedValueInterface extends ValueInterface, WrappedValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|ObjectValueInterface
     *
     * @throws InvalidAssertableExaminedValueException
     */
    public function getExaminedValue();
}
