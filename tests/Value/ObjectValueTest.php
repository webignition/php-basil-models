<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Identifier\AttributeIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\AttributeValue;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Value\EnvironmentValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ObjectNames;
use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\Value\ValueTypes;

class ObjectValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $type,
        string $reference,
        string $objectName,
        string $objectProperty
    ) {
        $value = new ObjectValue($type, $reference, $objectName, $objectProperty);

        $this->assertSame($type, $value->getType());
        $this->assertSame($reference, $value->getReference());
        $this->assertSame($objectName, $value->getObjectName());
        $this->assertSame($objectProperty, $value->getObjectProperty());
        $this->assertSame($reference, (string) $value);
    }

    public function createDataProvider(): array
    {
        return [
            'data parameter' => [
                'type' => ValueTypes::DATA_PARAMETER,
                'valueString' => '$data.key',
                'objectName' => ObjectNames::DATA,
                'objectProperty' => 'key',
            ],
            'page object property' => [
                'type' => ValueTypes::PAGE_OBJECT_PROPERTY,
                'valueString' => '$page.url',
                'objectName' => ObjectNames::PAGE,
                'objectProperty' => 'url',
            ],
            'browser object property' => [
                'type' => ValueTypes::BROWSER_OBJECT_PROPERTY,
                'valueString' => '$browser.title',
                'objectName' => ObjectNames::BROWSER,
                'objectProperty' => 'title',
            ],
            'element parameter' => [
                'type' => ValueTypes::ELEMENT_PARAMETER,
                'valueString' => '$elements.element_name',
                'objectName' => ObjectNames::ELEMENT,
                'objectProperty' => 'element_name',
            ],
            'page element reference' => [
                'type' => ValueTypes::PAGE_ELEMENT_REFERENCE,
                'valueString' => 'page_import_name.elements.element_name',
                'objectName' => 'page_import_name',
                'objectProperty' => 'element_name',
            ],
            'attribute parameter' => [
                'type' => ValueTypes::ATTRIBUTE_PARAMETER,
                'valueString' => '$elements.element_name.attribute_name',
                'objectName' => ObjectNames::ELEMENT,
                'objectProperty' => 'element_name.attribute_name',
            ],
        ];
    }

    public function testIsEmpty()
    {
        $emptyObjectValue = new ObjectValue(
            ValueTypes::PAGE_ELEMENT_REFERENCE,
            '',
            'page_import_name',
            'element_name'
        );

        $this->assertTrue($emptyObjectValue->isEmpty());

        $nonEmptyObjectValue = new ObjectValue(
            ValueTypes::PAGE_ELEMENT_REFERENCE,
            'page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $this->assertFalse($nonEmptyObjectValue->isEmpty());
    }

    /**
     * @dataProvider isActionableDataProvider
     */
    public function testIsActionable(ValueInterface $value, bool $expectedIsActionable)
    {
        $this->assertSame($expectedIsActionable, $value->isActionable());
    }

    public function isActionableDataProvider(): array
    {
        return [
            'literal css selector' => [
                'value' => LiteralValue::createCssSelectorValue('.selector'),
                'expectedIsActionable' => true,
            ],
            'literal string' => [
                'value' => LiteralValue::createStringValue('value'),
                'expectedIsActionable' => true,
            ],
            'literal xpath expression' => [
                'value' => LiteralValue::createXpathExpressionValue('//h1'),
                'expectedIsActionable' => true,
            ],
            'browser object property' => [
                'value' => new ObjectValue(ValueTypes::BROWSER_OBJECT_PROPERTY, '', '', ''),
                'expectedIsActionable' => true,
            ],
            'data parameter' => [
                'value' => new ObjectValue(ValueTypes::DATA_PARAMETER, '', '', ''),
                'expectedIsActionable' => true,
            ],
            'element parameter' => [
                'value' => new ObjectValue(ValueTypes::ELEMENT_PARAMETER, '', '', ''),
                'expectedIsActionable' => false,
            ],
            'page element reference' => [
                'value' => new ObjectValue(ValueTypes::PAGE_ELEMENT_REFERENCE, '', '', ''),
                'expectedIsActionable' => false,
            ],
            'page object property' => [
                'value' => new ObjectValue(ValueTypes::PAGE_OBJECT_PROPERTY, '', '', ''),
                'expectedIsActionable' => true,
            ],
            'attribute parameter' => [
                'value' => new ObjectValue(ValueTypes::ATTRIBUTE_PARAMETER, '', '', ''),
                'expectedIsActionable' => false,
            ],
            'environment parameter' => [
                'value' => new EnvironmentValue('', ''),
                'expectedIsActionable' => true,
            ],
            'element identifier value' => [
                'value' => new ElementValue(
                    new ElementIdentifier(
                        LiteralValue::createCssSelectorValue('.selector')
                    )
                ),
                'expectedIsActionable' => true,
            ],
            'attribute identifier value' => [
                'value' => new AttributeValue(
                    new AttributeIdentifier(
                        new ElementIdentifier(
                            LiteralValue::createCssSelectorValue('.selector')
                        ),
                        'attribute_name'
                    )
                ),
                'expectedIsActionable' => true,
            ],
        ];
    }
}
