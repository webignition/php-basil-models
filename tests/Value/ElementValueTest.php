<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueTypes;

class ElementValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.selector'));

        $value = new ElementValue($identifier);

        $this->assertSame(ValueTypes::ELEMENT_IDENTIFIER, $value->getType());
        $this->assertSame($identifier, $value->getIdentifier());
        $this->assertfalse($value->isEmpty());
        $this->assertTrue($value->isActionable());
        $this->assertSame('".selector"', $value->__toString());
    }
}
