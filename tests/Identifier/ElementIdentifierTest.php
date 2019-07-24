<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;

class ElementIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, string $value, int $expectedPosition, ?int $position = null)
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
                'value' => '.selector',
                'expectedPosition' => ElementIdentifier::DEFAULT_POSITION,
            ],
            'string value, has explicit position' => [
                'type' => IdentifierTypes::CSS_SELECTOR,
                'value' => '.selector',
                'expectedPosition' => 3,
                'position' => 3,
            ],
        ];
    }

    public function testWithParentIdentifier()
    {
        $identifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            '.selector'
        );

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            '.parent',
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
            '.parent',
            null,
            'parent_identifier_name'
        );

        $cssSelectorWithElementReference =
            (new ElementIdentifier(
                IdentifierTypes::CSS_SELECTOR,
                '.selector'
            ))->withParentIdentifier($parentIdentifier);

        $xpathExpressionWithElementReference =
            (new ElementIdentifier(
                IdentifierTypes::XPATH_EXPRESSION,
                '//foo'
            ))->withParentIdentifier($parentIdentifier);

        return [
            'css selector, position null' => [
                'identifier' => new ElementIdentifier(IdentifierTypes::CSS_SELECTOR, '.selector'),
                'expectedString' => '".selector"',
            ],
            'css selector, position 1' => [
                'identifier' => new ElementIdentifier(IdentifierTypes::CSS_SELECTOR, '.selector', 1),
                'expectedString' => '".selector"',
            ],
            'css selector, position 2' => [
                'identifier' => new ElementIdentifier(IdentifierTypes::CSS_SELECTOR, '.selector', 2),
                'expectedString' => '".selector":2',
            ],
            'xpath expression, position null' => [
                'identifier' => new ElementIdentifier(IdentifierTypes::XPATH_EXPRESSION, '//foo'),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 1' => [
                'identifier' => new ElementIdentifier(IdentifierTypes::XPATH_EXPRESSION, '//foo', 1),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 2' => [
                'identifier' => new ElementIdentifier(IdentifierTypes::XPATH_EXPRESSION, '//foo', 2),
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
            '.selector'
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
