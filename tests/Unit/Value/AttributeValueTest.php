<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Identifier\PageObjectIdentifier;
use webignition\BasilModel\Value\AttributeValue;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class AttributeValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = (new PageObjectIdentifier(
            new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
        ))->withAttributeName('attribute_name');

        $value = new AttributeValue($identifier);

        $this->assertSame($identifier, $value->getIdentifier());
        $this->assertfalse($value->isEmpty());
        $this->assertTrue($value->isActionable());
        $this->assertSame('".selector".attribute_name', $value->__toString());
    }
}
