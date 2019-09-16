<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\ValueInterface;

interface ExpectedValueInterface extends ValueInterface
{
    /**
     * @return AttributeValueInterface|ElementValueInterface|LiteralValueInterface|PageElementReference|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue();
}
