<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueTypes;

class LiteralValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new LiteralValue('foo');

        $this->assertSame(ValueTypes::STRING, $value->getType());
        $this->assertSame('foo', $value->getValue());
        $this->assertSame('"foo"', (string) $value);
    }

    public function testIsEmpty()
    {
        $this->assertTrue((new LiteralValue(''))->isEmpty());
        $this->assertFalse((new LiteralValue('non-empty'))->isEmpty());
    }

    public function testIsActionable()
    {
        $value = new LiteralValue('');

        $this->assertTrue($value->isActionable());
    }
}
