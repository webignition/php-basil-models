<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Exception\InvalidAssertionExpectedValueException;

class AssertionExpectedValue implements AssertionExpectedValueInterface
{
    /**
     * @var AttributeValueInterface|BrowserProperty|ElementValueInterface|EnvironmentValueInterface|LiteralValueInterface|PageElementReference|ReferenceValueInterface
     */
    private $expectedValue;

    /**
     * @param ValueInterface $value
     *
     * @throws InvalidAssertionExpectedValueException
     */
    public function __construct(ValueInterface $value)
    {
        if (!($value instanceof AttributeValueInterface ||
            $value instanceof BrowserProperty ||
            $value instanceof ElementValueInterface ||
            $value instanceof EnvironmentValueInterface ||
            $value instanceof LiteralValueInterface ||
            $value instanceof PageElementReference ||
            $value instanceof ReferenceValueInterface
        )) {
            throw new InvalidAssertionExpectedValueException($value);
        }

        $this->expectedValue = $value;
    }

    /**
     * @return AttributeValueInterface|BrowserProperty|ElementValueInterface|EnvironmentValueInterface|LiteralValueInterface|PageElementReference|ReferenceValueInterface
     */
    public function getExpectedValue()
    {
        return $this->expectedValue;
    }

    public function isEmpty(): bool
    {
        return $this->getExpectedValue()->isEmpty();
    }

    public function isActionable(): bool
    {
        return $this->getExpectedValue()->isActionable();
    }

    public function __toString(): string
    {
        return (string) $this->getExpectedValue();
    }
}
