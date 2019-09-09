<?php

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\DataParameter;

class DataParameterTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $value = new DataParameter('$data.key', 'key');

        $this->assertSame('$data.key', $value->getReference());
        $this->assertSame('key', $value->getProperty());
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
