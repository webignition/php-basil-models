<?php

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\AttributeReference;

class AttributeReferenceTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $reference = new AttributeReference(
            '$elements.element_name.attribute_name',
            'element_name.attribute_name'
        );

        $this->assertSame('$elements.element_name.attribute_name', $reference->getReference());
        $this->assertSame('element_name.attribute_name', $reference->getProperty());
        $this->assertFalse($reference->isActionable());
        $this->assertSame('$elements.element_name.attribute_name', (string) $reference);
    }

    public function testIsEmpty()
    {
        $reference = new AttributeReference(
            '$elements.element_name.attribute_name',
            'element_name.attribute_name'
        );

        $this->assertFalse($reference->isEmpty());

        $emptyReference = new AttributeReference(
            '',
            'element_name.attribute_name'
        );

        $this->assertTrue($emptyReference->isEmpty());
    }
}
