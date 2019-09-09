<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ElementValue;

class ElementValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new ElementIdentifier(new CssSelector('.selector'));

        $value = new ElementValue($identifier);

        $this->assertSame($identifier, $value->getIdentifier());
        $this->assertfalse($value->isEmpty());
        $this->assertTrue($value->isActionable());
        $this->assertSame('".selector"', $value->__toString());
    }
}
