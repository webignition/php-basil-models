<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\ValueTypes;

class ObjectValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $type,
        string $valueString,
        string $objectName,
        string $objectProperty,
        string $expectedString
    ) {
        $value = new ObjectValue($type, $valueString, $objectName, $objectProperty);

        $this->assertSame($type, $value->getType());
        $this->assertSame($valueString, $value->getValue());
        $this->assertSame($objectName, $value->getObjectName());
        $this->assertSame($objectProperty, $value->getObjectProperty());
        $this->assertSame($expectedString, (string) $value);
    }

    public function createDataProvider(): array
    {
        return [
            'type: page object property' => [
                'type' => ValueTypes::PAGE_OBJECT_PROPERTY,
                'valueString' => '$page.url',
                'objectName' => 'page',
                'objectProperty' => 'url',
                'expectedString' => '$page.url',
            ],
            'type: browser object property' => [
                'type' => ValueTypes::BROWSER_OBJECT_PROPERTY,
                'valueString' => '$browser.title',
                'objectName' => 'browser',
                'objectProperty' => 'title',
                'expectedString' => '$browser.title',
            ],
        ];
    }
}
