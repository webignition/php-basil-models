<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Identifier\AttributeIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\AttributeValue;
use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ValueTypes;

class AttributeValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new AttributeIdentifier(
            new ElementIdentifier(new CssSelector('.selector')),
            'attribute_name'
        );

        $value = new AttributeValue($identifier);

        $this->assertSame(ValueTypes::ATTRIBUTE_IDENTIFIER, $value->getType());
        $this->assertSame($identifier, $value->getIdentifier());
        $this->assertfalse($value->isEmpty());
        $this->assertTrue($value->isActionable());
        $this->assertSame('".selector".attribute_name', $value->__toString());
    }
}
