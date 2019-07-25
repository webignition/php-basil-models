<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\ObjectNames;
use webignition\BasilModel\Value\ObjectValue;
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

    public function testIsActionable()
    {
        $browserObjectParameterValue = new ObjectValue(ValueTypes::BROWSER_OBJECT_PROPERTY, '', '', '');
        $dataParameterObjectValue = new ObjectValue(ValueTypes::DATA_PARAMETER, '', '', '');
        $elementParameterObjectValue = new ObjectValue(ValueTypes::ELEMENT_PARAMETER, '', '', '');
        $pageElementReferenceObjectValue = new ObjectValue(ValueTypes::PAGE_ELEMENT_REFERENCE, '', '', '');
        $pageObjectPropertyObjectValue = new ObjectValue(ValueTypes::PAGE_OBJECT_PROPERTY, '', '', '');

        $this->assertTrue($browserObjectParameterValue->isActionable());
        $this->assertTrue($dataParameterObjectValue->isActionable());
        $this->assertTrue($elementParameterObjectValue->isActionable());
        $this->assertFalse($pageElementReferenceObjectValue->isActionable());
        $this->assertTrue($pageObjectPropertyObjectValue->isActionable());
    }
}
