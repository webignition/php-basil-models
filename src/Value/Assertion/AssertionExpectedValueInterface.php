<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\AttributeValueInterface;
use webignition\BasilModel\Value\BrowserProperty;
use webignition\BasilModel\Value\DataParameter;
use webignition\BasilModel\Value\ElementValueInterface;
use webignition\BasilModel\Value\EnvironmentValueInterface;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\PageProperty;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\ValueInterface;

interface AssertionExpectedValueInterface extends ValueInterface
{
    /**
     * @return AttributeValueInterface|BrowserProperty|DataParameter|ElementValueInterface|EnvironmentValueInterface|LiteralValueInterface|PageProperty|PageElementReference|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue();
}
