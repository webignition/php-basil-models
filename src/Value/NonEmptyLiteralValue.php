<?php

namespace webignition\BasilModel\Value;

class NonEmptyLiteralValue extends LiteralValue implements LiteralValueInterface
{
    private function __construct(string $type, string $value)
    {
        if ('' === trim($value)) {
            throw new \RuntimeException('value cannot be empty');
        }

        parent::__construct($type, $value);
    }

    public static function createStringValue(string $value): NonEmptyLiteralValue
    {
        return new NonEmptyLiteralValue(ValueTypes::STRING, $value);
    }

    public static function createCssSelectorValue(string $value): NonEmptyLiteralValue
    {
        return new NonEmptyLiteralValue(ValueTypes::CSS_SELECTOR, $value);
    }

    public static function createXpathExpressionValue(string $value): NonEmptyLiteralValue
    {
        return new NonEmptyLiteralValue(ValueTypes::XPATH_EXPRESSION, $value);
    }

    public function isEmpty(): bool
    {
        return false;
    }
}
