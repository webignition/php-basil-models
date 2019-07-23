<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ObjectValue;
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
                'value' => new LiteralValue('.selector'),
                'expectedPosition' => Identifier::DEFAULT_POSITION,
            ],
            'string value, has explicit position' => [
                'type' => IdentifierTypes::CSS_SELECTOR,
                'value' => new LiteralValue('.selector'),
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
            new LiteralValue('.selector')
        );

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new LiteralValue('.parent'),
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
        $cssSelectorIdentifierValue = new LiteralValue('.selector');
        $xpathExpressionIdentifierValue = new LiteralValue('//foo');

        $parentIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new LiteralValue('.parent'),
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
                        ValueTypes::PAGE_ELEMENT_REFERENCE,
                        'page_import_name.elements.element_name',
                        'page_import_name',
                        'element_name'
                    )
                ),
                'expectedString' => 'page_import_name.elements.element_name',
            ],
            'page model element reference, position 1' => [
                'identifier' => new Identifier(
                    IdentifierTypes::PAGE_MODEL_ELEMENT_REFERENCE,
                    new ObjectValue(
                        ValueTypes::PAGE_ELEMENT_REFERENCE,
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
                        ValueTypes::PAGE_ELEMENT_REFERENCE,
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

    /**
     * @dataProvider withNameDataProvider
     */
    public function testWithName(IdentifierInterface $identifier, string $name, IdentifierInterface $expectedIdentifier)
    {
        $updatedIdentifier = $identifier->withName($name);

        $this->assertNotSame($identifier, $updatedIdentifier);
        $this->assertEquals($expectedIdentifier, $updatedIdentifier);
    }

    public function withNameDataProvider(): array
    {
        return [
            'no name, no new name' => [
                'identifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector')
                ),
                'name' => '',
                'expectedIdentifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector')
                ),
            ],
            'has name, no new name' => [
                'identifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector'),
                    null,
                    'identifier name'
                ),
                'name' => '',
                'expectedIdentifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector')
                ),
            ],
            'no name, has new name' => [
                'identifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector')
                ),
                'name' => 'identifier name',
                'expectedIdentifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector'),
                    null,
                    'identifier name'
                ),
            ],
            'has name, has new name' => [
                'identifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector'),
                    null,
                    'current identifier name'
                ),
                'name' => 'new identifier name',
                'expectedIdentifier' => new Identifier(
                    IdentifierTypes::CSS_SELECTOR,
                    new LiteralValue('.selector'),
                    null,
                    'new identifier name'
                ),
            ],
        ];
    }

    /**
     * @dataProvider isActionableDataProvider
     */
    public function testIsActionable(IdentifierInterface $identifier, bool $expectedIsActionable)
    {
        $this->assertSame($expectedIsActionable, $identifier->isActionable());
    }

    public function isActionableDataProvider(): array
    {
        $value = new LiteralValue('');

        return [
            'css selector is actionable' => [
                'identifier' => new Identifier(IdentifierTypes::CSS_SELECTOR, $value),
                'expectedIsActionable' => true,
            ],
            'xpath expression is actionable' => [
                'identifier' => new Identifier(IdentifierTypes::XPATH_EXPRESSION, $value),
                'expectedIsActionable' => true,
            ],
            'page model element reference is not actionable' => [
                'identifier' => new Identifier(IdentifierTypes::PAGE_MODEL_ELEMENT_REFERENCE, $value),
                'expectedIsActionable' => false,
            ],
            'element parameter is actionable' => [
                'identifier' => new Identifier(IdentifierTypes::ELEMENT_PARAMETER, $value),
                'expectedIsActionable' => true,
            ],
            'page object parameter is not actionable' => [
                'identifier' => new Identifier(IdentifierTypes::PAGE_OBJECT_PARAMETER, $value),
                'expectedIsActionable' => false,
            ],
        ];
    }

    /**
     * @dataProvider isAssertableDataProvider
     */
    public function testIsAssertable(IdentifierInterface $identifier, bool $expectedIsActionable)
    {
        $this->assertSame($expectedIsActionable, $identifier->isAssertable());
    }

    public function isAssertableDataProvider(): array
    {
        $value = new LiteralValue('');

        return [
            'css selector is assertable' => [
                'identifier' => new Identifier(IdentifierTypes::CSS_SELECTOR, $value),
                'expectedIsAssertable' => true,
            ],
            'xpath expression is assertable' => [
                'identifier' => new Identifier(IdentifierTypes::XPATH_EXPRESSION, $value),
                'expectedIsAssertable' => true,
            ],
            'page model element reference is not assertable' => [
                'identifier' => new Identifier(IdentifierTypes::PAGE_MODEL_ELEMENT_REFERENCE, $value),
                'expectedIsAssertable' => false,
            ],
            'element parameter is not assertable' => [
                'identifier' => new Identifier(IdentifierTypes::ELEMENT_PARAMETER, $value),
                'expectedIsAssertable' => true,
            ],
            'page object parameter is assertable' => [
                'identifier' => new Identifier(IdentifierTypes::PAGE_OBJECT_PARAMETER, $value),
                'expectedIsAssertable' => true,
            ],
        ];
    }
}
