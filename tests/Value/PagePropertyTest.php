<?php

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\ObjectNames;
use webignition\BasilModel\Value\PageProperty;
use webignition\BasilModel\Value\ValueTypes;

class PagePropertyTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new PageProperty('$page.title', 'title');

        $this->assertSame(ValueTypes::PAGE_OBJECT_PROPERTY, $value->getType());
        $this->assertSame('$page.title', $value->getReference());
        $this->assertSame(ObjectNames::PAGE, $value->getObjectName());
        $this->assertSame('title', $value->getObjectProperty());
        $this->assertTrue($value->isActionable());
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new PageProperty('$page.title', 'title'))->isEmpty());
        $this->assertTrue((new PageProperty('', ''))->isEmpty());
    }

    public function testToString()
    {
        $this->assertSame(
            '$page.title',
            (string) (new PageProperty('$page.title', 'title'))
        );
    }
}
