<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\NonEmptyLiteralValue;
use webignition\BasilModel\Value\ValueTypes;

class NonEmptyLiteralValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateStringValue()
    {
        $value = NonEmptyLiteralValue::createStringValue('foo');

        $this->assertSame(ValueTypes::STRING, $value->getType());
        $this->assertSame('foo', $value->getValue());
        $this->assertSame('"foo"', (string) $value);
    }

    public function testCreateCssSelectorValue()
    {
        $value = NonEmptyLiteralValue::createCssSelectorValue('.selector');

        $this->assertSame(ValueTypes::CSS_SELECTOR, $value->getType());
        $this->assertSame('.selector', $value->getValue());
        $this->assertSame('".selector"', (string) $value);
    }

    public function testCreateXpathExpressionValue()
    {
        $value = NonEmptyLiteralValue::createXpathExpressionValue('//foo');

        $this->assertSame(ValueTypes::XPATH_EXPRESSION, $value->getType());
        $this->assertSame('//foo', $value->getValue());
        $this->assertSame('"//foo"', (string) $value);
    }

    public function testIsEmpty()
    {
        $this->assertFalse((NonEmptyLiteralValue::createStringValue('non-empty'))->isEmpty());
    }

    public function testIsActionable()
    {
        $value = NonEmptyLiteralValue::createStringValue('non-empty');

        $this->assertTrue($value->isActionable());
    }

    public function testCreateWithEmptyValueThrowsRuntimeException()
    {
        $this->expectException(\RuntimeException::class);

        NonEmptyLiteralValue::createStringValue('');
    }
}
