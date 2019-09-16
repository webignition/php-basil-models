<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Identifier\IdentifierCollection;
use webignition\BasilModel\Identifier\PageObjectIdentifier;
use webignition\BasilModel\Tests\TestIdentifierFactory;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class IdentifierCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(array $identifiers, IdentifierCollection $expectedIdentifierCollection)
    {
        $identifierCollection = new IdentifierCollection($identifiers);

        $this->assertEquals($expectedIdentifierCollection, $identifierCollection);
    }

    public function createDataProvider(): array
    {
        $validIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR),
            1,
            'heading'
        );

        return [
            'invalid, not correct object type' => [
                'identifiers' => [
                    1,
                    'string',
                    true
                ],
                'expectedIdentifierCollection' => new IdentifierCollection(),
            ],
            'invalid, lacking names' => [
                'identifiers' => [
                    new PageObjectIdentifier(new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR)),
                ],
                'expectedIdentifierCollection' => new IdentifierCollection([
                    new PageObjectIdentifier(new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR)),
                ]),
            ],
            'valid' => [
                'identifiers' => [
                    $validIdentifier,
                ],
                'expectedIdentifierCollection' => new IdentifierCollection([
                    $validIdentifier,
                ]),
            ],
        ];
    }

    public function testGetIdentifier()
    {
        $headingIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR),
            1,
            'heading'
        );

        $identifierCollection = new IdentifierCollection([
            $headingIdentifier,
        ]);

        $this->assertSame($headingIdentifier, $identifierCollection->getIdentifier('heading'));
        $this->assertNull($identifierCollection->getIdentifier('not-present'));
    }

    public function testIterator()
    {
        $headingIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR),
            1,
            'heading'
        );

        $identifiers = [
            $headingIdentifier,
        ];

        $identifierCollection = new IdentifierCollection($identifiers);

        foreach ($identifierCollection as $index => $identifier) {
            $this->assertSame($identifiers[$index], $identifier);
        }
    }
}
