<?php

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\AttributeReference;
use webignition\BasilModel\Value\ObjectNames;
use webignition\BasilModel\Value\ValueTypes;

class AttributeReferenceTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $reference = new AttributeReference(
            '$elements.element_name.attribute_name',
            ObjectNames::ELEMENT,
            'element_name.attribute_name'
        );

        $this->assertSame(ValueTypes::ATTRIBUTE_PARAMETER, $reference->getType());
        $this->assertSame('$elements.element_name.attribute_name', $reference->getReference());
        $this->assertSame(ObjectNames::ELEMENT, $reference->getObject());
        $this->assertSame('element_name.attribute_name', $reference->getProperty());
        $this->assertTrue($reference->isActionable());
        $this->assertSame('$elements.element_name.attribute_name', (string) $reference);
    }

    public function testIsEmpty()
    {
        $reference = new AttributeReference(
            '$elements.element_name.attribute_name',
            ObjectNames::ELEMENT,
            'element_name.attribute_name'
        );

        $this->assertFalse($reference->isEmpty());

        $emptyReference = new AttributeReference(
            '',
            ObjectNames::ELEMENT,
            'element_name.attribute_name'
        );

        $this->assertTrue($emptyReference->isEmpty());
    }
}
