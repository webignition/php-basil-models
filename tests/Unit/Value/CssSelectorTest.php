<?php

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Value\CssSelector;

class CssSelectorTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $expression = new CssSelector('.selector');

        $this->assertSame('.selector', $expression->getExpression());
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
