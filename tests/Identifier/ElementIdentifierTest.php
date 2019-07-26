<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\LiteralValueInterface;

class ElementIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(LiteralValueInterface $value, int $expectedPosition, ?int $position = null)
    {
        $identifier = new ElementIdentifier($value, $position);

        $this->assertSame(IdentifierTypes::ELEMENT_SELECTOR, $identifier->getType());
        $this->assertSame($value, $identifier->getValue());
        $this->assertSame($expectedPosition, $identifier->getPosition());
        $this->assertNull($identifier->getName());
        $this->assertNull($identifier->getAttributeName());
    }

    public function createDataProvider(): array
    {
        return [
            'string value, no explicit position' => [
                'value' => LiteralValue::createCssSelectorValue('.selector'),
                'expectedPosition' => ElementIdentifier::DEFAULT_POSITION,
            ],
            'string value, has explicit position' => [
                'value' => LiteralValue::createCssSelectorValue('.selector'),
                'expectedPosition' => 3,
                'position' => 3,
            ],
        ];
    }

    public function testWithParentIdentifier()
    {
        $identifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.selector'));

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = new ElementIdentifier(
            LiteralValue::createCssSelectorValue('.parent'),
            1,
            'parent_name'
        );

        $identifierWithElementReference = $identifier->withParentIdentifier($parentIdentifier);

        $this->assertNotSame($identifier, $identifierWithElementReference);
        $this->assertSame($parentIdentifier, $identifierWithElementReference->getParentIdentifier());
    }

    /**
     * @dataProvider toStringDataProvider
     */
    public function testToString(ElementIdentifierInterface $identifier, string $expectedString)
    {
        $this->assertSame($expectedString, (string) $identifier);
    }

    public function toStringDataProvider(): array
    {
        $parentIdentifier = new ElementIdentifier(
            LiteralValue::createCssSelectorValue('.parent'),
            1,
            'parent_identifier_name'
        );

        $cssSelectorWithElementReference =
            (new ElementIdentifier(
                LiteralValue::createCssSelectorValue('.selector')
            ))->withParentIdentifier($parentIdentifier);

        $xpathExpressionWithElementReference =
            (new ElementIdentifier(
                LiteralValue::createXpathExpressionValue('//foo')
            ))->withParentIdentifier($parentIdentifier);

        return [
            'css selector, position null' => [
                'identifier' => new ElementIdentifier(LiteralValue::createCssSelectorValue('.selector')),
                'expectedString' => '".selector"',
            ],
            'css selector, position null with attribute name' => [
                'identifier' => (new ElementIdentifier(
                    LiteralValue::createCssSelectorValue('.selector')
                ))->withAttributeName('attribute_name'),
                'expectedString' => '".selector".attribute_name',
            ],
            'css selector, position 1' => [
                'identifier' => new ElementIdentifier(
                    LiteralValue::createCssSelectorValue('.selector'),
                    1
                ),
                'expectedString' => '".selector"',
            ],
            'css selector, position 1 with attribute name' => [
                'identifier' => (new ElementIdentifier(
                    LiteralValue::createCssSelectorValue('.selector'),
                    1
                ))->withAttributeName('attribute_name'),
                'expectedString' => '".selector".attribute_name',
            ],
            'css selector, position 2' => [
                'identifier' => new ElementIdentifier(
                    LiteralValue::createCssSelectorValue('.selector'),
                    2
                ),
                'expectedString' => '".selector":2',
            ],
            'css selector, position 2 with attribute name' => [
                'identifier' => (new ElementIdentifier(
                    LiteralValue::createCssSelectorValue('.selector'),
                    2
                ))->withAttributeName('attribute_name'),
                'expectedString' => '".selector":2.attribute_name',
            ],
            'xpath expression, position null' => [
                'identifier' => new ElementIdentifier(LiteralValue::createXpathExpressionValue('//foo')),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 1' => [
                'identifier' => new ElementIdentifier(
                    LiteralValue::createXpathExpressionValue('//foo'),
                    1
                ),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 2' => [
                'identifier' => new ElementIdentifier(
                    LiteralValue::createXpathExpressionValue('//foo'),
                    2
                ),
                'expectedString' => '"//foo":2',
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
    public function testWithName(
        ElementIdentifierInterface $identifier,
        string $name,
        ElementIdentifierInterface $expectedIdentifier
    ) {
        $updatedIdentifier = $identifier->withName($name);

        $this->assertNotSame($identifier, $updatedIdentifier);
        $this->assertEquals($expectedIdentifier, $updatedIdentifier);
    }

    public function withNameDataProvider(): array
    {
        $identifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.selector'));

        return [
            'no name, no new name' => [
                'identifier' => $identifier,
                'name' => '',
                'expectedIdentifier' => $identifier,
            ],
            'has name, no new name' => [
                'identifier' => $identifier->withName('identifier name'),
                'name' => '',
                'expectedIdentifier' => $identifier,
            ],
            'no name, has new name' => [
                'identifier' => $identifier,
                'name' => 'identifier name',
                'expectedIdentifier' => $identifier->withName('identifier name'),
            ],
            'has name, has new name' => [
                'identifier' => $identifier->withName('current identifier name'),
                'name' => 'new identifier name',
                'expectedIdentifier' => $identifier->withName('new identifier name'),
            ],
        ];
    }

    /**
     * @dataProvider withAttributeNameDataProvider
     */
    public function testWithAttributeName(
        ElementIdentifierInterface $identifier,
        string $attributeName,
        ElementIdentifierInterface $expectedIdentifier
    ) {
        $updatedIdentifier = $identifier->withAttributeName($attributeName);

        $this->assertNotSame($identifier, $updatedIdentifier);
        $this->assertEquals($expectedIdentifier, $updatedIdentifier);
    }

    public function withAttributeNameDataProvider(): array
    {
        $identifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.selector'));

        return [
            'no attribute name, no new attribute name' => [
                'identifier' => $identifier,
                'attributeName' => '',
                'expectedIdentifier' => $identifier,
            ],
            'has attribute name, no new attribute name' => [
                'identifier' => $identifier->withAttributeName('attribute_name'),
                'attributeName' => '',
                'expectedIdentifier' => $identifier,
            ],
            'no attribute name, has new attribute name' => [
                'identifier' => $identifier,
                'attributeName' => 'attribute_name',
                'expectedIdentifier' => $identifier->withAttributeName('attribute_name'),
            ],
            'has attribute name, has new attribute name' => [
                'identifier' => $identifier->withAttributeName('current_attribute_name'),
                'attributeName' => 'new_attribute_name',
                'expectedIdentifier' => $identifier->withAttributeName('new_attribute_name'),
            ],
        ];
    }
}
