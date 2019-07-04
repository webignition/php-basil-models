<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueInterface;
use webignition\BasilModel\Value\ValueTypes;

class IdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, ValueInterface $value, int $expectedPosition, ?int $position = null)
    {
        $identifier = new Identifier($type, $value, $position);

        $this->assertSame($type, $identifier->getType());
        $this->assertSame($value, $identifier->getValue());
        $this->assertSame($expectedPosition, $identifier->getPosition());
    }

    public function createDataProvider(): array
    {
        return [
            'string value, no explicit position' => [
                'type' => IdentifierTypes::CSS_SELECTOR,
                'value' => new Value(ValueTypes::STRING, '.foo'),
                'expectedPosition' => Identifier::DEFAULT_POSITION,
            ],
            'string value, has explicit position' => [
                'type' => IdentifierTypes::CSS_SELECTOR,
                'value' => new Value(ValueTypes::STRING, '.foo'),
                'expectedPosition' => 3,
                'position' => 3,
            ],
            'object value' => [
                'type' => IdentifierTypes::PAGE_OBJECT_PARAMETER,
                'value' => new ObjectValue(ValueTypes::PAGE_OBJECT_PROPERTY, '$page.url', 'page', 'url'),
                'expectedPosition' => Identifier::DEFAULT_POSITION
            ],
        ];
    }

    public function testWithParentIdentifier()
    {
        $identifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(ValueTypes::STRING, '.selector')
        );

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(ValueTypes::STRING, '.parent'),
            null,
            'parent_name'
        );

        $identifierWithElementReference = $identifier->withParentIdentifier($parentIdentifier);

        $this->assertNotSame($identifier, $identifierWithElementReference);
        $this->assertSame($parentIdentifier, $identifierWithElementReference->getParentIdentifier());
    }

    /**
     * @dataProvider toStringDataProvider
     */
    public function testToString(IdentifierInterface $identifier, string $expectedString)
    {
        $this->assertSame($expectedString, (string) $identifier);
    }

    public function toStringDataProvider(): array
    {
        $cssSelectorIdentifierValue = new Value(ValueTypes::STRING, '.selector');
        $xpathExpressionIdentifierValue = new Value(ValueTypes::STRING, '//foo');

        $parentIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(ValueTypes::STRING, '.parent'),
            null,
            'parent_identifier_name'
        );

        $cssSelectorWithElementReference =
            (new Identifier(
                IdentifierTypes::CSS_SELECTOR,
                $cssSelectorIdentifierValue
            ))->withParentIdentifier($parentIdentifier);

        $xpathExpressionWithElementReference =
            (new Identifier(
                IdentifierTypes::XPATH_EXPRESSION,
                $xpathExpressionIdentifierValue
            ))->withParentIdentifier($parentIdentifier);

        return [
            'css selector, position null' => [
                'identifier' => new Identifier(IdentifierTypes::CSS_SELECTOR, $cssSelectorIdentifierValue),
                'expectedString' => '".selector"',
            ],
            'css selector, position 1' => [
                'identifier' => new Identifier(IdentifierTypes::CSS_SELECTOR, $cssSelectorIdentifierValue, 1),
                'expectedString' => '".selector"',
            ],
            'css selector, position 2' => [
                'identifier' => new Identifier(IdentifierTypes::CSS_SELECTOR, $cssSelectorIdentifierValue, 2),
                'expectedString' => '".selector":2',
            ],
            'xpath expression, position null' => [
                'identifier' => new Identifier(IdentifierTypes::XPATH_EXPRESSION, $xpathExpressionIdentifierValue),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 1' => [
                'identifier' => new Identifier(IdentifierTypes::XPATH_EXPRESSION, $xpathExpressionIdentifierValue, 1),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 2' => [
                'identifier' => new Identifier(IdentifierTypes::XPATH_EXPRESSION, $xpathExpressionIdentifierValue, 2),
                'expectedString' => '"//foo":2',
            ],
            'page model element reference, position null' => [
                'identifier' => new Identifier(
                    IdentifierTypes::PAGE_MODEL_ELEMENT_REFERENCE,
                    new ObjectValue(
                        ValueTypes::PAGE_MODEL_REFERENCE,
                        'page_model.elements.element_name',
                        'page_model',
                        'element_name'
                    )
                ),
                'expectedString' => 'page_model.elements.element_name',
            ],
            'page model element reference, position 1' => [
                'identifier' => new Identifier(
                    IdentifierTypes::PAGE_MODEL_ELEMENT_REFERENCE,
                    new ObjectValue(
                        ValueTypes::PAGE_MODEL_REFERENCE,
                        'page_model.elements.element_name',
                        'page_model',
                        'element_name'
                    ),
                    1
                ),
                'expectedString' => 'page_model.elements.element_name',
            ],
            'page model element reference, position 2' => [
                'identifier' => new Identifier(
                    IdentifierTypes::PAGE_MODEL_ELEMENT_REFERENCE,
                    new ObjectValue(
                        ValueTypes::PAGE_MODEL_REFERENCE,
                        'page_model.elements.element_name',
                        'page_model',
                        'element_name'
                    ),
                    2
                ),
                'expectedString' => 'page_model.elements.element_name:2',
            ],
            'element parameter, position null' => [
                'identifier' => new Identifier(
                    IdentifierTypes::ELEMENT_PARAMETER,
                    new ObjectValue(
                        ValueTypes::ELEMENT_PARAMETER,
                        '$elements.element_name',
                        'elements',
                        'element_name'
                    )
                ),
                'expectedString' => '$elements.element_name',
            ],
            'element parameter, position 1' => [
                'identifier' => new Identifier(
                    IdentifierTypes::ELEMENT_PARAMETER,
                    new ObjectValue(
                        ValueTypes::ELEMENT_PARAMETER,
                        '$elements.element_name',
                        'elements',
                        'element_name'
                    ),
                    1
                ),
                'expectedString' => '$elements.element_name',
            ],
            'element parameter, position 2' => [
                'identifier' => new Identifier(
                    IdentifierTypes::ELEMENT_PARAMETER,
                    new ObjectValue(
                        ValueTypes::ELEMENT_PARAMETER,
                        '$elements.element_name',
                        'elements',
                        'element_name'
                    ),
                    2
                ),
                'expectedString' => '$elements.element_name:2',
            ],
            'css selector with element reference, position null' => [
                'identifier' => $cssSelectorWithElementReference,
                'expectedString' => '"{{ parent_identifier_name }} .selector"',
            ],
            'xpath expression with element reference, position null' => [
                'identifier' => $xpathExpressionWithElementReference,
                'expectedString' => '"{{ parent_identifier_name }} //foo"',
            ],
        ];
    }
}
