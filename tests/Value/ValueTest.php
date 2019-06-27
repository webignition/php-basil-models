<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueTypes;

class ValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider toStringDataProvider
     */
    public function testToString(string $type, string $valueString, string $expectedString)
    {
        $value = new Value($type, $valueString);

        $this->assertSame($expectedString, (string) $value);
    }

    public function toStringDataProvider(): array
    {
        return [
            'type: string' => [
                'type' => ValueTypes::STRING,
                'valueString' => 'foo',
                'expectedString' => '"foo"',
            ],
            'type: data parameter' => [
                'type' => ValueTypes::DATA_PARAMETER,
                'valueString' => '$data.foo',
                'expectedString' => '$data.foo',
            ],
            'type: element parameter' => [
                'type' => ValueTypes::ELEMENT_PARAMETER,
                'valueString' => '$elements.foo',
                'expectedString' => '$elements.foo',
            ],
        ];
    }
}
