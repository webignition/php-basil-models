<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Identifier\PageObjectIdentifier;
use webignition\BasilModel\Identifier\PageObjectIdentifierCollection;
use webignition\BasilModel\Tests\TestIdentifierFactory;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class PageObjectIdentifierCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(array $identifiers, PageObjectIdentifierCollection $expectedIdentifierCollection)
    {
        $identifierCollection = new PageObjectIdentifierCollection($identifiers);

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
                'expectedIdentifierCollection' => new PageObjectIdentifierCollection(),
            ],
            'invalid, lacking names' => [
                'identifiers' => [
                    new PageObjectIdentifier(new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR)),
                ],
                'expectedIdentifierCollection' => new PageObjectIdentifierCollection([
                    new PageObjectIdentifier(new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR)),
                ]),
            ],
            'valid' => [
                'identifiers' => [
                    $validIdentifier,
                ],
                'expectedIdentifierCollection' => new PageObjectIdentifierCollection([
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

        $identifierCollection = new PageObjectIdentifierCollection([
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

        $identifierCollection = new PageObjectIdentifierCollection($identifiers);

        foreach ($identifierCollection as $index => $identifier) {
            $this->assertSame($identifiers[$index], $identifier);
        }
    }

    public function testReplace()
    {
        $oldParentIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
            null,
            'parent'
        );

        $childIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.child', ElementExpressionType::CSS_SELECTOR),
            null,
            'child',
            $oldParentIdentifier
        );

        $collection = new PageObjectIdentifierCollection([
            $oldParentIdentifier,
            $childIdentifier,
        ]);

        $newParentIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
            1,
            'parent'
        );

        $expectedNewChildIdentifier = TestIdentifierFactory::createObjectIdentifier(
            new ElementExpression('.child', ElementExpressionType::CSS_SELECTOR),
            null,
            'child',
            $newParentIdentifier
        );

        $mutatedCollection = $collection->replace($oldParentIdentifier, $newParentIdentifier);

        $this->assertSame($newParentIdentifier, $mutatedCollection->getIdentifier('parent'));
        $this->assertEquals($expectedNewChildIdentifier, $mutatedCollection->getIdentifier('child'));
    }
}
