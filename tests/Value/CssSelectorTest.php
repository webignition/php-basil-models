<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ValueTypes;

class CssSelectorTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $expression = new CssSelector('.selector');

        $this->assertSame('.selector', $expression->getExpression());
        $this->assertSame(ValueTypes::CSS_SELECTOR, $expression->getType());
        $this->assertTrue($expression->isActionable());
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new CssSelector('.selector'))->isEmpty());
        $this->assertTrue((new CssSelector(''))->isEmpty());
    }

    public function testToString()
    {
        $this->assertSame(
            '".selector"',
            (string) (new CssSelector('.selector'))
        );
    }
}
