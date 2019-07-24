<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueTypes;

class LiteralValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateStringValue()
    {
        $value = LiteralValue::createStringValue('foo');

        $this->assertSame(ValueTypes::STRING, $value->getType());
        $this->assertSame('foo', $value->getValue());
        $this->assertSame('"foo"', (string) $value);
    }

    public function testCreateCssSelectorValue()
    {
        $value = LiteralValue::createCssSelectorValue('.selector');

        $this->assertSame(ValueTypes::CSS_SELECTOR, $value->getType());
        $this->assertSame('.selector', $value->getValue());
        $this->assertSame('".selector"', (string) $value);
    }

    public function testCreateXpathExpressionValue()
    {
        $value = LiteralValue::createXpathExpressionValue('//foo');

        $this->assertSame(ValueTypes::XPATH_EXPRESSION, $value->getType());
        $this->assertSame('//foo', $value->getValue());
        $this->assertSame('"//foo"', (string) $value);
    }

    public function testIsEmpty()
    {
        $this->assertTrue((LiteralValue::createStringValue(''))->isEmpty());
        $this->assertFalse((LiteralValue::createStringValue('non-empty'))->isEmpty());
    }

    public function testIsActionable()
    {
        $value = LiteralValue::createStringValue('');

        $this->assertTrue($value->isActionable());
    }
}
