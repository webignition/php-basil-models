<?php

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Value\PageProperty;

class PagePropertyTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new PageProperty('$page.title', 'title');

        $this->assertSame('$page.title', $value->getReference());
        $this->assertSame('title', $value->getProperty());
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
