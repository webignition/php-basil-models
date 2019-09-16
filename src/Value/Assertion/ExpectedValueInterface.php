<?php

namespace webignition\BasilModel\Value\Assertion;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;
use webignition\BasilModel\Value\LiteralValueInterface;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\DomIdentifierValueInterface;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\ValueInterface;

interface ExpectedValueInterface extends ValueInterface
{
    /**
     * @return LiteralValueInterface|PageElementReference|DomIdentifierValueInterface|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue();
}
