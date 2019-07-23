<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

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
}
