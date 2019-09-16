<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExpectedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\ValueInterface;

interface AssertableExpectedValueInterface extends ValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|LiteralValueInterface|ObjectValueInterface
     *
     * @throws InvalidAssertableExpectedValueException
     */
    public function getExpectedValue();
}
