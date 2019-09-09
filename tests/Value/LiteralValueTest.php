<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\LiteralValue;

class LiteralValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new LiteralValue('foo');

        $this->assertSame('foo', $value->getValue());
        $this->assertSame('"foo"', (string) $value);
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new LiteralValue('non-empty'))->isEmpty());
        $this->assertTrue((new LiteralValue(''))->isEmpty());
    }

    public function testIsActionable()
    {
        $this->assertTrue((new LiteralValue(''))->isActionable());
    }
}
