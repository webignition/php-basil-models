<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\ObjectValueInterface;
use webignition\BasilModel\Value\ObjectValueType;

class ObjectValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, string $reference, string $property, string $default)
    {
        $value = new ObjectValue($type, $reference, $property, $default);

        $this->assertSame($type, $value->getType());
        $this->assertSame($reference, $value->getReference());
        $this->assertSame($property, $value->getProperty());
        $this->assertSame($default, $value->getDefault());
        $this->assertFalse($value->isEmpty());
        $this->assertSame($reference, $value->__toString());
    }

    public function createDataProvider(): array
    {
        return [
            'browser property' => [
                'type' => ObjectValueType::BROWSER_PROPERTY,
                'reference' =>  '$browser.size',
                'property' => 'size',
                'default' => '',
            ],
            'data parameter' => [
                'type' => ObjectValueType::DATA_PARAMETER,
                'reference' =>  '$data.key',
                'property' => 'key',
                'default' => '',
            ],
            'environment parameter, no default' => [
                'type' => ObjectValueType::ENVIRONMENT_PARAMETER,
                'reference' =>  '$env.KEY',
                'property' => 'KEY',
                'default' => '',
            ],
            'environment parameter, with default' => [
                'type' => ObjectValueType::ENVIRONMENT_PARAMETER,
                'reference' =>  '$env.KEY',
                'property' => 'KEY',
                'default' => 'default value',
            ],
            'page property' => [
                'type' => ObjectValueType::PAGE_PROPERTY,
                'reference' =>  '$page.title',
                'property' => 'title',
                'default' => '',
            ],
        ];
    }

    /**
     * @dataProvider isActionableDataProvider
     */
    public function testIsActionable(ObjectValueInterface $value, bool $expectedIsActionable)
    {
        $this->assertSame($expectedIsActionable, $value->isActionable());
    }

    public function isActionableDataProvider(): array
    {
        return [
            'browser property' => [
                'value' => new ObjectValue(
                    ObjectValueType::BROWSER_PROPERTY,
                    '$browser.size',
                    'size'
                ),
                'expectedIsActionable' => true,
            ],
            'data parameter' => [
                'value' => new ObjectValue(
                    ObjectValueType::DATA_PARAMETER,
                    '$data.key',
                    'key'
                ),
                'expectedIsActionable' => true,
            ],
            'environment parameter, no default' => [
                'value' => new ObjectValue(
                    ObjectValueType::ENVIRONMENT_PARAMETER,
                    '$env.KEY',
                    'KEY'
                ),
                'expectedIsActionable' => true,
            ],
            'environment parameter, with default' => [
                'value' => new ObjectValue(
                    ObjectValueType::ENVIRONMENT_PARAMETER,
                    '$env.KEY',
                    'KEY'
                ),
                'expectedIsActionable' => true,
            ],
            'page property' => [
                'value' => new ObjectValue(
                    ObjectValueType::PAGE_PROPERTY,
                    '$page.title',
                    'title'
                ),
                'expectedIsActionable' => true,
            ],
        ];
    }
}
