<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExpectedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class AssertableExpectedValue extends WrappedValue implements AssertableExpectedValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|LiteralValueInterface|ObjectValueInterface
     *
     * @throws InvalidAssertableExpectedValueException
     */
    public function getExpectedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof AttributeValueInterface ||
            $value instanceof ElementValueInterface ||
            $value instanceof LiteralValueInterface ||
            $value instanceof ObjectValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertableExpectedValueException($value);
    }
}
