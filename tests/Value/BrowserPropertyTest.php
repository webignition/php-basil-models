<?php

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\BrowserProperty;
use webignition\BasilModel\Value\ObjectNames;
use webignition\BasilModel\Value\ValueTypes;

class BrowserPropertyTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new BrowserProperty('$browser.size', 'size');

        $this->assertSame(ValueTypes::BROWSER_OBJECT_PROPERTY, $value->getType());
        $this->assertSame('$browser.size', $value->getReference());
        $this->assertSame(ObjectNames::BROWSER, $value->getObjectName());
        $this->assertSame('size', $value->getObjectProperty());
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
