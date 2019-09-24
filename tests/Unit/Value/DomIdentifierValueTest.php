<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Value\DomIdentifierValue;

class DomIdentifierValueTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = (new DomIdentifier('.selector'))->withAttributeName('attribute_name');

        $value = new DomIdentifierValue($identifier);

        $this->assertSame($identifier, $value->getIdentifier());
        $this->assertfalse($value->isEmpty());
        $this->assertTrue($value->isActionable());
        $this->assertSame('".selector".attribute_name', $value->__toString());
    }
}
