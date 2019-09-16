<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Identifier\DomIdentifierInterface;
use webignition\BasilModel\Tests\TestIdentifierFactory;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class DomIdentifierTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $elementExpression = new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR);

        $identifier = new DomIdentifier($elementExpression);

        $this->assertSame($elementExpression, $identifier->getElementExpression());
        $this->assertNull($identifier->getPosition());
        $this->assertNull($identifier->getAttributeName());
        $this->assertNull($identifier->getName());
    }

    public function testWithPosition()
    {
        $position = 1;
        $identifier = new DomIdentifier(new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR));
        $identifierWithPosition = $identifier->withPosition($position);

        $this->assertNull($identifier->getPosition());
        $this->assertNotSame($identifier, $identifierWithPosition);
        $this->assertSame($position, $identifierWithPosition->getPosition());
    }

    public function testWithParentIdentifier()
    {
        $identifier = new DomIdentifier(new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR));

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
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
        $identifier = new DomIdentifier(new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR));
        $identifierWithAttributeName = $identifier->withAttributeName($attributeName);

        $this->assertNull($identifier->getPosition());
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
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
            1,
            'parent_name'
        );

        $cssSelectorWithElementReference = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR),
            null,
            null,
            $parentIdentifier
        );

        $xpathExpressionWithElementReference = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('//foo', ElementExpressionType::XPATH_EXPRESSION),
            null,
            null,
            $parentIdentifier
        );

        return [
            'css selector, no position, no attribute name, no parent identifier' => [
                'identifier' => new DomIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                ),
                'expectedString' => '".selector"',
            ],
            'css selector with position 1' => [
                'identifier' => (new DomIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                ))->withPosition(1),
                'expectedString' => '".selector"',
            ],
            'css selector with position 2' => [
                'identifier' => (new DomIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                ))->withPosition(2),
                'expectedString' => '".selector":2',
            ],
            'css selector with attribute name' => [
                'identifier' => (new DomIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                ))->withAttributeName('attribute_name'),
                'expectedString' => '".selector".attribute_name',
            ],
            'xpath expression' => [
                'identifier' => new DomIdentifier(
                    new ElementExpression('//foo', ElementExpressionType::XPATH_EXPRESSION)
                ),
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
        $identifier = new DomIdentifier(new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR));

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
