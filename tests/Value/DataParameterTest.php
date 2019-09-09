<?php

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\DataParameter;
use webignition\BasilModel\Value\ObjectNames;
use webignition\BasilModel\Value\ValueTypes;

class DataParameterTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new DataParameter('$data.key', 'key');

        $this->assertSame(ValueTypes::DATA_PARAMETER, $value->getType());
        $this->assertSame('$data.key', $value->getReference());
        $this->assertSame(ObjectNames::DATA, $value->getObjectName());
        $this->assertSame('key', $value->getObjectProperty());
        $this->assertTrue($value->isActionable());
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new DataParameter('$data.key', 'key'))->isEmpty());
        $this->assertTrue((new DataParameter('', ''))->isEmpty());
    }

    public function testToString()
    {
        $this->assertSame(
            '$data.key',
            (string) (new DataParameter('$data.key', 'key'))
        );
    }
}
