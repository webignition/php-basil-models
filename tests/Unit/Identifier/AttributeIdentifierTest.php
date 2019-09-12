<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Identifier\AttributeIdentifier;
use webignition\BasilModel\Identifier\AttributeIdentifierInterface;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class AttributeIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(ElementIdentifierInterface $elementIdentifier, string $attributeName)
    {
        $identifier = new AttributeIdentifier($elementIdentifier, $attributeName);

        $this->assertSame($elementIdentifier, $identifier->getElementIdentifier());
        $this->assertSame($attributeName, $identifier->getAttributeName());
    }

    public function createDataProvider(): array
    {
        return [
            'empty attribute name' => [
                'elementIdentifier' => new ElementIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                ),
                'attributeName' => '',
            ],
            'non-empty attribute name' => [
                'elementIdentifier' => new ElementIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
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
                        new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                    ),
                    ''
                ),
                'expectedString' => '".selector"',
            ],
            'non-empty attribute name' => [
                'attributeIdentifier' => new AttributeIdentifier(
                    new ElementIdentifier(
                        new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                    ),
                    'attribute-name'
                ),
                'expectedString' => '".selector".attribute-name',
            ],
        ];
    }
}
