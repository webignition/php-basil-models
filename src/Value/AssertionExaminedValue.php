<?php

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Exception\InvalidAssertionExaminedValueException;

class AssertionExaminedValue implements AssertionExaminedValueInterface
{
    /**
     * @var AttributeValueInterface|BrowserProperty|DataParameter|ElementValueInterface|EnvironmentValueInterface|PageElementReference|PageProperty|ReferenceValueInterface
     */
    private $examinedValue;

    /**
     * @param ValueInterface $value
     *
     * @throws InvalidAssertionExaminedValueException
     */
    public function __construct(ValueInterface $value)
    {
        if (!($value instanceof AttributeValueInterface ||
            $value instanceof BrowserProperty ||
            $value instanceof DataParameter ||
            $value instanceof ElementValueInterface ||
            $value instanceof EnvironmentValueInterface ||
            $value instanceof PageProperty ||
            $value instanceof PageElementReference ||
            $value instanceof ReferenceValueInterface
        )) {
            throw new InvalidAssertionExaminedValueException($value);
        }

        $this->examinedValue = $value;
    }

    /**
     * @return AttributeValueInterface|BrowserProperty|DataParameter|ElementValueInterface|EnvironmentValueInterface|PageElementReference|PageProperty|ReferenceValueInterface
     */
    public function getExaminedValue()
    {
        return $this->examinedValue;
    }

    public function isEmpty(): bool
    {
        return $this->getExaminedValue()->isEmpty();
    }

    public function isActionable(): bool
    {
        return $this->getExaminedValue()->isActionable();
    }

    public function __toString(): string
    {
        return (string) $this->getExaminedValue();
    }
}
