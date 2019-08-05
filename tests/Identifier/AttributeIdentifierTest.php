<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\AttributeIdentifier;
use webignition\BasilModel\Identifier\AttributeIdentifierInterface;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\LiteralValue;

class AttributeIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(ElementIdentifierInterface $elementIdentifier, string $attributeName)
    {
        $identifier = new AttributeIdentifier($elementIdentifier, $attributeName);

        $this->assertSame(IdentifierTypes::ATTRIBUTE, $identifier->getType());
        $this->assertSame($elementIdentifier, $identifier->getElementIdentifier());
        $this->assertSame($attributeName, $identifier->getAttributeName());
    }

    public function createDataProvider(): array
    {
        return [
            'empty attribute name' => [
                'elementIdentifier' => new ElementIdentifier(
                    LiteralValue::createCssSelectorValue('.selector')
                ),
                'attributeName' => '',
            ],
            'non-empty attribute name' => [
                'elementIdentifier' => new ElementIdentifier(
                    LiteralValue::createCssSelectorValue('.selector')
                ),
                'attributeName' => 'attribute-name',
            ],
        ];
    }

    /**
     * @dataProvider toStringDataProvider
     */
    public function testToString(AttributeIdentifierInterface $attributeIdentifier, string $expectedString)
    {
        $this->assertSame($expectedString, (string) $attributeIdentifier);
    }

    public function toStringDataProvider(): array
    {
        return [
            'empty attribute name' => [
                'attributeIdentifier' => new AttributeIdentifier(
                    new ElementIdentifier(
                        LiteralValue::createCssSelectorValue('.selector')
                    ),
                    ''
                ),
                'expectedString' => '".selector"',
            ],
            'non-empty attribute name' => [
                'attributeIdentifier' => new AttributeIdentifier(
                    new ElementIdentifier(
                        LiteralValue::createCssSelectorValue('.selector')
                    ),
                    'attribute-name'
                ),
                'expectedString' => '".selector".attribute-name',
            ],
        ];
    }
}
