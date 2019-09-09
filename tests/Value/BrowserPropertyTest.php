<?php

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\BrowserProperty;

class BrowserPropertyTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new BrowserProperty('$browser.size', 'size');

        $this->assertSame('$browser.size', $value->getReference());
        $this->assertSame('size', $value->getProperty());
        $this->assertTrue($value->isActionable());
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new BrowserProperty('$browser.size', 'size'))->isEmpty());
        $this->assertTrue((new BrowserProperty('', ''))->isEmpty());
    }

    public function testToString()
    {
        $this->assertSame(
            '$browser.size',
            (string) (new BrowserProperty('$browser.size', 'size'))
        );
    }
}
