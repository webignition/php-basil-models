<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\ElementValue;

class ElementValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new ElementIdentifier(new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR));

        $value = new ElementValue($identifier);

        $this->assertSame($identifier, $value->getIdentifier());
        $this->assertfalse($value->isEmpty());
        $this->assertTrue($value->isActionable());
        $this->assertSame('".selector"', $value->__toString());
    }
}
