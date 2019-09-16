<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value\Reference;

use webignition\BasilModel\Value\Reference\ReferenceValueType;
use webignition\BasilModel\Value\Reference\TypedReferenceValue;
use webignition\BasilModel\Value\Reference\TypedReferenceValueInterface;

class TypedReferenceValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, string $reference, string $property, string $default)
    {
        $value = new TypedReferenceValue($type, $reference, $property, $default);

        $this->assertSame($type, $value->getType());
        $this->assertSame($reference, $value->getReference());
        $this->assertSame($property, $value->getProperty());
        $this->assertSame($default, $value->getDefault());
        $this->assertFalse($value->isEmpty());
    }

    public function createDataProvider(): array
    {
        return [
            'attribute reference' => [
                'type' => ReferenceValueType::ATTRIBUTE_REFERENCE,
                'reference' =>  '$elements.element_name.attribute_name',
                'property' => 'element_name.attribute_name',
                'default' => '',
            ],
            'browser property' => [
                'type' => ReferenceValueType::BROWSER_PROPERTY,
                'reference' =>  '$browser.size',
                'property' => 'size',
                'default' => '',
            ],
            'data parameter' => [
                'type' => ReferenceValueType::DATA_PARAMETER,
                'reference' =>  '$data.key',
                'property' => 'key',
                'default' => '',
            ],
            'element reference' => [
                'type' => ReferenceValueType::ELEMENT_REFERENCE,
                'reference' =>  '$elements.element_name',
                'property' => 'element_name',
                'default' => '',
            ],
            'environment parameter, no default' => [
                'type' => ReferenceValueType::ENVIRONMENT_PARAMETER,
                'reference' =>  '$env.KEY',
                'property' => 'KEY',
                'default' => '',
            ],
            'environment parameter, with default' => [
                'type' => ReferenceValueType::ENVIRONMENT_PARAMETER,
                'reference' =>  '$env.KEY',
                'property' => 'KEY',
                'default' => 'default value',
            ],
            'page property' => [
                'type' => ReferenceValueType::PAGE_PROPERTY,
                'reference' =>  '$page.title',
                'property' => 'title',
                'default' => '',
            ],
        ];
    }

    /**
     * @dataProvider isActionableDataProvider
     */
    public function testIsActionable(TypedReferenceValueInterface $value, bool $expectedIsActionable)
    {
        $this->assertSame($expectedIsActionable, $value->isActionable());
    }

    public function isActionableDataProvider(): array
    {
        return [
            'attribute reference' => [
                'value' => new TypedReferenceValue(
                    ReferenceValueType::ATTRIBUTE_REFERENCE,
                    '$elements.element_name.attribute_name',
                    'element_name.attribute_name'
                ),
                'expectedIsActionable' => false,
            ],
            'browser property' => [
                'value' => new TypedReferenceValue(
                    ReferenceValueType::BROWSER_PROPERTY,
                    '$browser.size',
                    'size'
                ),
                'expectedIsActionable' => true,
            ],
            'data parameter' => [
                'value' => new TypedReferenceValue(
                    ReferenceValueType::DATA_PARAMETER,
                    '$data.key',
                    'key'
                ),
                'expectedIsActionable' => true,
            ],
            'element reference' => [
                'value' => new TypedReferenceValue(
                    ReferenceValueType::ELEMENT_REFERENCE,
                    '$elements.element_name',
                    'element_name'
                ),
                'expectedIsActionable' => false,
            ],
            'environment parameter, no default' => [
                'value' => new TypedReferenceValue(
                    ReferenceValueType::ENVIRONMENT_PARAMETER,
                    '$env.KEY',
                    'KEY'
                ),
                'expectedIsActionable' => true,
            ],
            'environment parameter, with default' => [
                'value' => new TypedReferenceValue(
                    ReferenceValueType::ENVIRONMENT_PARAMETER,
                    '$env.KEY',
                    'KEY'
                ),
                'expectedIsActionable' => true,
            ],
            'page property' => [
                'value' => new TypedReferenceValue(
                    ReferenceValueType::PAGE_PROPERTY,
                    '$page.title',
                    'title'
                ),
                'expectedIsActionable' => true,
            ],
        ];
    }
}
