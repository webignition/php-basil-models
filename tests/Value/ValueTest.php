<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Value;

use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\Value\ValueTypes;

class ValueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, string $valueString, string $expectedString)
    {
        $value = new Value($type, $valueString);

        $this->assertSame($type, $value->getType());
        $this->assertSame($valueString, $value->getValue());
        $this->assertSame($expectedString, (string) $value);
    }

    public function createDataProvider(): array
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

    public function testIsEmpty()
    {
        $this->assertTrue((new Value(ValueTypes::STRING, ''))->isEmpty());
        $this->assertFalse((new Value(ValueTypes::STRING, 'non-empty'))->isEmpty());
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
            'data parameter is actionable' => [
                'value' => new ObjectValue(
                    ValueTypes::DATA_PARAMETER,
                    '$data.foo',
                    'data',
                    'foo'
                ),
                'expectedIsActionable' => true,
            ],
            'string is actionable' => [
                'value' => new Value(
                    ValueTypes::STRING,
                    'foo'
                ),
                'expectedIsActionable' => true,
            ],
            'element parameter is actionable' => [
                'value' => new ObjectValue(
                    ValueTypes::ELEMENT_PARAMETER,
                    '$elements.foo',
                    'elements',
                    'foo'
                ),
                'expectedIsActionable' => true,
            ],
            'page object parameter is actionable' => [
                'value' => new ObjectValue(
                    ValueTypes::PAGE_OBJECT_PROPERTY,
                    '$page.url',
                    'page',
                    'url'
                ),
                'expectedIsActionable' => true,
            ],
            'browser object parameter is actionable' => [
                'value' => new ObjectValue(
                    ValueTypes::BROWSER_OBJECT_PROPERTY,
                    '$browser.size',
                    'browser',
                    'size'
                ),
                'expectedIsActionable' => true,
            ],
            'page model element reference is not actionable' => [
                'value' => new Value(
                    ValueTypes::PAGE_MODEL_REFERENCE,
                    'page_import_name.elements.element_name'
                ),
                'expectedIsActionable' => false,
            ],
        ];
    }
}
