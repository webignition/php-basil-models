<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertableExpectedValueException;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\PageObjectValueInterface;
use webignition\BasilModel\Value\ValueInterface;

interface AssertableExpectedValueInterface extends ValueInterface
{
    /**
     * @return LiteralValueInterface|ObjectValueInterface|PageObjectValueInterface
     *
     * @throws InvalidAssertableExpectedValueException
     */
    public function getExpectedValue();
}
