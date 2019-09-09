<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\XpathExpression;

class XpathExpressionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $expression = new XpathExpression('//foo');

        $this->assertSame('//foo', $expression->getExpression());
        $this->assertTrue($expression->isActionable());
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new XpathExpression('//foo'))->isEmpty());
        $this->assertTrue((new XpathExpression(''))->isEmpty());
    }

    public function testToString()
    {
        $this->assertSame(
            '"//foo"',
            (string) (new XpathExpression('//foo'))
        );
    }
}
