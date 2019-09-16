<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExpectedValueException;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\PageObjectValueInterface;
use webignition\BasilModel\Value\WrappedValue;

class AssertableExpectedValue extends WrappedValue implements AssertableExpectedValueInterface
{
    /**
     * @return LiteralValueInterface|ObjectValueInterface|PageObjectValueInterface
     *
     * @throws InvalidAssertableExpectedValueException
     */
    public function getExpectedValue()
    {
        $value = $this->getWrappedValue();

        if ($value instanceof LiteralValueInterface ||
            $value instanceof ObjectValueInterface ||
            $value instanceof PageObjectValueInterface
        ) {
            return $value;
        }

        throw new InvalidAssertableExpectedValueException($value);
    }
}
