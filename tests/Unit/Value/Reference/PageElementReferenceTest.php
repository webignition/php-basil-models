<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value\Reference;

use webignition\BasilModel\Value\PageElementReference;

class PageElementReferenceTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $reference = 'page_import_name.elements.element_name';
        $object = 'page_import_name';
        $property = 'element_name';

        $value = new PageElementReference($reference, $object, $property);

        $this->assertSame($reference, $value->getReference());
        $this->assertSame($object, $value->getObject());
        $this->assertSame($property, $value->getProperty());
        $this->assertFalse($value->isEmpty());
        $this->assertFalse($value->isActionable());
    }
}
