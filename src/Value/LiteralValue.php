<?php

namespace webignition\BasilModel\Value;

class LiteralValue extends AbstractValue implements LiteralValueInterface
{
    private $value;

    private function __construct(string $type, string $value)
    {
        parent::__construct($type);

        $this->value = $value;
    }

    public static function createStringValue(string $value)
    {
        return new LiteralValue(ValueTypes::STRING, $value);
    }

    public static function createCssSelectorValue(string $value)
    {
        return new LiteralValue(ValueTypes::CSS_SELECTOR, $value);
    }

    public static function createXpathExpressionValue(string $value)
    {
        return new LiteralValue(ValueTypes::XPATH_EXPRESSION, $value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return '' === $this->value;
    }

    public function isActionable(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return '"' . $this->value . '"';
    }
}
