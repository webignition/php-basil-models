<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierCollection;
use webignition\BasilModel\Tests\TestIdentifierFactory;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class ElementIdentifierCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(array $identifiers, ElementIdentifierCollection $expectedIdentifierCollection)
    {
        $identifierCollection = new ElementIdentifierCollection($identifiers);

        $this->assertEquals($expectedIdentifierCollection, $identifierCollection);
    }

    public function createDataProvider(): array
    {
        return [
            'invalid, not correct object type' => [
                'identifiers' => [
                    1,
                    'string',
                    true
                ],
                'expectedIdentifierCollection' => new ElementIdentifierCollection(),
            ],
            'invalid, lacking names' => [
                'identifiers' => [
                    new ElementIdentifier(new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR)),
                ],
                'expectedIdentifierCollection' => new ElementIdentifierCollection([
                    new ElementIdentifier(new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR)),
                ]),
            ],
            'valid' => [
                'identifiers' => [
                    (new ElementIdentifier(
                        new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR),
                        1
                    ))->withName('heading'),
                ],
                'expectedIdentifierCollection' => new ElementIdentifierCollection([
                    (new ElementIdentifier(
                        new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR),
                        1
                    ))->withName('heading'),
                ]),
            ],
        ];
    }

    public function testGetIdentifier()
    {
        $headingIdentifier = (new ElementIdentifier(
            new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR),
            1
        ))->withName('heading');

        $identifierCollection = new ElementIdentifierCollection([
            $headingIdentifier,
        ]);

        $this->assertSame($headingIdentifier, $identifierCollection->getIdentifier('heading'));
        $this->assertNull($identifierCollection->getIdentifier('not-present'));
    }

    public function testIterator()
    {
        $headingIdentifier = (new ElementIdentifier(
            new ElementExpression('.heading', ElementExpressionType::CSS_SELECTOR),
            1
        ))->withName('heading');

        $identifiers = [
            $headingIdentifier,
        ];

        $identifierCollection = new ElementIdentifierCollection($identifiers);

        foreach ($identifierCollection as $index => $identifier) {
            $this->assertSame($identifiers[$index], $identifier);
        }
    }

    public function testReplace()
    {
        $oldParentIdentifier = TestIdentifierFactory::createElementIdentifier(
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
            null,
            'parent'
        );

        $childIdentifier = TestIdentifierFactory::createElementIdentifier(
            new ElementExpression('.child', ElementExpressionType::CSS_SELECTOR),
            null,
            'child',
            $oldParentIdentifier
        );

        $collection = new ElementIdentifierCollection([
            $oldParentIdentifier,
            $childIdentifier,
        ]);

        $newParentIdentifier = TestIdentifierFactory::createElementIdentifier(
            new ElementExpression('.parent', ElementExpressionType::CSS_SELECTOR),
            1,
            'parent'
        );

        $expectedNewChildIdentifier = TestIdentifierFactory::createElementIdentifier(
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
