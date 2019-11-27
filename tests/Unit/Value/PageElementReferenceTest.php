<?php

declare(strict_types=1);

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Value\PageElementReference;

class PageElementReferenceTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new PageElementReference(
            '$page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $this->assertSame('$page_import_name.elements.element_name', $value->getReference());
        $this->assertSame('page_import_name', $value->getObject());
        $this->assertSame('element_name', $value->getProperty());
        $this->assertFalse($value->isActionable());
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new PageElementReference('$page_import_name.elements.element_name', '', ''))->isEmpty());
        $this->assertTrue((new PageElementReference('', '', ''))->isEmpty());
    }

    public function testToString()
    {
        $value = new PageElementReference(
            '$page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $this->assertSame('$page_import_name.elements.element_name', (string) $value);
    }
}
