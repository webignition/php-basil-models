<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Tests\TestIdentifierFactory;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionInterface;
use webignition\BasilModel\Value\ElementExpressionType;

class ElementIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(ElementExpressionInterface $elementExpression, ?int $position, ?int $expectedPosition)
    {
        $identifier = new ElementIdentifier($elementExpression, $position);

        $this->assertSame($elementExpression, $identifier->getElementExpression());
        $this->assertSame($expectedPosition, $identifier->getPosition());
        $this->assertNull($identifier->getName());
    }

    public function createDataProvider(): array
    {
        return [
            'no explicit position' => [
                'elementExpression' => new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR),
                'position' => null,
                'expectedPosition' => null,
            ],
            'has explicit position' => [
                'elementExpression' => new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR),
                'position' => 3,
                'expectedPosition' => 3,
            ],
        ];
    }

    public function testWithParentIdentifier()
    {
        $identifier = new ElementIdentifier(new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR));

        $this->assertNull($identifier->getParentIdentifier());

        $parentIdentifier = TestIdentifierFactory::createElementIdentifier(
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
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
        $parentIdentifier = TestIdentifierFactory::createElementIdentifier(
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
            1,
            'parent_name'
        );

        $cssSelectorWithElementReference =
            (new ElementIdentifier(
                new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
            ))->withParentIdentifier($parentIdentifier);

        $xpathExpressionWithElementReference =
            (new ElementIdentifier(
                new ElementExpression('//foo', ElementExpressionType::XPATH_EXPRESSION)
            ))->withParentIdentifier($parentIdentifier);

        return [
            'css selector, position null' => [
                'identifier' => new ElementIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                ),
                'expectedString' => '".selector"',
            ],
            'css selector, position 1' => [
                'identifier' => new ElementIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR),
                    1
                ),
                'expectedString' => '".selector"',
            ],
            'css selector, position 2' => [
                'identifier' => new ElementIdentifier(
                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR),
                    2
                ),
                'expectedString' => '".selector":2',
            ],
            'xpath expression, position null' => [
                'identifier' => new ElementIdentifier(
                    new ElementExpression('//foo', ElementExpressionType::XPATH_EXPRESSION)
                ),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 1' => [
                'identifier' => new ElementIdentifier(
                    new ElementExpression('//foo', ElementExpressionType::XPATH_EXPRESSION),
                    1
                ),
                'expectedString' => '"//foo"',
            ],
            'xpath expression, position 2' => [
                'identifier' => new ElementIdentifier(
                    new ElementExpression('//foo', ElementExpressionType::XPATH_EXPRESSION),
                    2
                ),
                'expectedString' => '"//foo":2',
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
        $identifier = new ElementIdentifier(new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR));

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

    public function testWithPosition()
    {
        $identifier = new ElementIdentifier(
            new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
        );

        $this->assertNull($identifier->getPosition());

        $position = 1;

        $mutatedIdentifier = $identifier->withPosition($position);

        $this->assertNotSame($identifier, $mutatedIdentifier);
        $this->assertSame($position, $mutatedIdentifier->getPosition());
    }
}
