<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Identifier\DomIdentifierInterface;
use webignition\BasilModel\Tests\TestIdentifierFactory;

class DomIdentifierTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $locator = '.selector';

        $identifier = new DomIdentifier($locator);

        $this->assertSame($locator, $identifier->getLocator());
        $this->assertNull($identifier->getOrdinalPosition());
        $this->assertNull($identifier->getAttributeName());
        $this->assertNull($identifier->getName());
    }

    public function testWithOrdinalPosition()
    {
        $position = 1;
        $identifier = new DomIdentifier('.selector');
        $identifierWithPosition = $identifier->withOrdinalPosition($position);

        $this->assertNull($identifier->getOrdinalPosition());
        $this->assertNotSame($identifier, $identifierWithPosition);
        $this->assertSame($position, $identifierWithPosition->getOrdinalPosition());
    }

    public function testWithParentIdentifier()
    {
        $identifier = new DomIdentifier('.selector');

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = TestIdentifierFactory::createObjectIdentifier(
            '.parent',
            1,
            'parent_name'
        );

        $identifierWithElementReference = $identifier->withParentIdentifier($parentIdentifier);

        $this->assertNotSame($identifier, $identifierWithElementReference);
        $this->assertSame($parentIdentifier, $identifierWithElementReference->getParentIdentifier());
    }

    public function testWithAttributeName()
    {
        $attributeName = 'attribute_name';
        $identifier = new DomIdentifier('.selector');
        $identifierWithAttributeName = $identifier->withAttributeName($attributeName);

        $this->assertNull($identifier->getOrdinalPosition());
        $this->assertNotSame($identifier, $identifierWithAttributeName);
        $this->assertSame($attributeName, $identifierWithAttributeName->getAttributeName());
    }

    /**
     * @dataProvider toStringDataProvider
     */
    public function testToString(DomIdentifierInterface $identifier, string $expectedString)
    {
        $this->assertSame($expectedString, (string) $identifier);
    }

    public function toStringDataProvider(): array
    {
        $parentIdentifier = TestIdentifierFactory::createObjectIdentifier(
            '.parent',
            1,
            'parent_name'
        );

        $cssSelectorWithElementReference = TestIdentifierFactory::createObjectIdentifier(
            '.selector',
            null,
            null,
            $parentIdentifier
        );

        $xpathExpressionWithElementReference = TestIdentifierFactory::createObjectIdentifier(
            '//foo',
            null,
            null,
            $parentIdentifier
        );

        return [
            'css selector, no position, no attribute name, no parent identifier' => [
                'identifier' => new DomIdentifier('.selector'),
                'expectedString' => '".selector"',
            ],
            'css selector with position 1' => [
                'identifier' => (new DomIdentifier('.selector'))->withOrdinalPosition(1),
                'expectedString' => '".selector"',
            ],
            'css selector with position 2' => [
                'identifier' => (new DomIdentifier('.selector'))->withOrdinalPosition(2),
                'expectedString' => '".selector":2',
            ],
            'css selector with attribute name' => [
                'identifier' => (new DomIdentifier('.selector'))->withAttributeName('attribute_name'),
                'expectedString' => '".selector".attribute_name',
            ],
            'xpath expression' => [
                'identifier' => new DomIdentifier('//foo'),
                'expectedString' => '"//foo"',
            ],
            'css selector with element reference, position null' => [
                'identifier' => $cssSelectorWithElementReference,
                'expectedString' => '"{{ parent_name }} .selector"',
            ],
            'xpath expression with element reference, position null' => [
                'identifier' => $xpathExpressionWithElementReference,
                'expectedString' => '"{{ parent_name }} //foo"',
            ],
        ];
    }

    /**
     * @dataProvider withNameDataProvider
     */
    public function testWithName(
        DomIdentifierInterface $identifier,
        string $name,
        DomIdentifierInterface $expectedIdentifier
    ) {
        $updatedIdentifier = $identifier->withName($name);

        $this->assertNotSame($identifier, $updatedIdentifier);
        $this->assertEquals($expectedIdentifier, $updatedIdentifier);
    }

    public function withNameDataProvider(): array
    {
        $identifier = new DomIdentifier('.selector');

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
