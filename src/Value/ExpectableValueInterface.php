<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;

interface ExpectableValueInterface extends ValueInterface
{
    /**
     * @return LiteralValueInterface|PageElementReference|DomIdentifierValueInterface|ReferenceValueInterface
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function getExpectedValue();
}
