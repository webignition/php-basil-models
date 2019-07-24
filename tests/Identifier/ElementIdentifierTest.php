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
    public function testCreate(string $type, LiteralValueInterface $value, int $expectedPosition, ?int $position = null)
    {
        $identifier = new ElementIdentifier($type, $value, $position);

        $this->assertSame($type, $identifier->getType());
        $this->assertSame($value, $identifier->getValue());
        $this->assertSame($expectedPosition, $identifier->getPosition());
    }

    public function createDataProvider(): array
    {
        return [
            'string value, no explicit position' => [
                'type' => IdentifierTypes::CSS_SELECTOR,
                'value' => LiteralValue::createCssSelectorValue('.selector'),
                'expectedPosition' => ElementIdentifier::DEFAULT_POSITION,
            ],
            'string value, has explicit position' => [
                'type' => IdentifierTypes::CSS_SELECTOR,
                'value' => LiteralValue::createCssSelectorValue('.selector'),
                'expectedPosition' => 3,
                'position' => 3,
            ],
        ];
    }

    public function testWithParentIdentifier()
    {
        $identifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.selector')
        );

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.parent'),
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
    public function testToString(ElementIdentifierInterface $identifier, string $expectedString)
    {
        $this->assertSame($expectedString, (string) $identifier);
    }

    public function toStringDataProvider(): array
    {
        $parentIdentifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.parent'),
            1,
            'parent_identifier_name'
        );

        $cssSelectorWithElementReference =
            (new ElementIdentifier(
                IdentifierTypes::CSS_SELECTOR,
                LiteralValue::createCssSelectorValue('.selector')
            ))->withParentIdentifier($parentIdentifier);

        $xpathExpressionWithElementReference =
            (new ElementIdentifier(
                IdentifierTypes::XPATH_EXPRESSION,
                LiteralValue::createXpathExpressionValue('//foo')
            ))->withParentIdentifier($parentIdentifier);

        return [
            'css selector, position null' => [
                'identifier' => new ElementIdentifier(
                    IdentifierTypes::CSS_SELECTOR,
                    LiteralValue::createCssSelectorValue('.selector')
                ),
                'expectedString' => '".selector"',
            ],
            'css selector, position 1' => [
                'identifier' => new ElementIdentifier(
                    IdentifierTypes::CSS_SELECTOR,
                    LiteralValue::createCssSelectorValue('.selector'),
                    1
                ),
                'expectedString' => '".selector"',
            ],
            'css selector, position 2' => [
                'identifier' => new ElementIdentifier(
                    IdentifierTypes::CSS_SELECTOR,
                    LiteralValue::createCssSelectorValue('.selector'),
                    2
                ),
                'expectedString' => '".selector":2',
            ],
            'xpath expression, position null' => [
                'identifier' => new ElementIdentifier(
                    IdentifierTypes::XPATH_EXPRESSION,
                    LiteralValue::createXpathExpressionValue('//foo')
                ),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 1' => [
                'identifier' => new ElementIdentifier(
                    IdentifierTypes::XPATH_EXPRESSION,
                    LiteralValue::createXpathExpressionValue('//foo'),
                    1
                ),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 2' => [
                'identifier' => new ElementIdentifier(
                    IdentifierTypes::XPATH_EXPRESSION,
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
        $identifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.selector')
        );

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
}
