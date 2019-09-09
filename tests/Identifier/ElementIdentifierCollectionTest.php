<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierCollection;
use webignition\BasilModel\Tests\TestIdentifierFactory;
use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ValueTypes;

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
                    new ElementIdentifier(new CssSelector('.heading')),
                ],
                'expectedIdentifierCollection' => new ElementIdentifierCollection([
                    new ElementIdentifier(new CssSelector('.heading')),
                ]),
            ],
            'valid' => [
                'identifiers' => [
                    (new ElementIdentifier(
                        new CssSelector('.heading'),
                        1
                    ))->withName('heading'),
                ],
                'expectedIdentifierCollection' => new ElementIdentifierCollection([
                    (new ElementIdentifier(
                        new CssSelector('.heading'),
                        1
                    ))->withName('heading'),
                ]),
            ],
        ];
    }

    public function testGetIdentifier()
    {
        $headingIdentifier = (new ElementIdentifier(
            new CssSelector('.heading'),
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
            new CssSelector('.heading'),
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
            ValueTypes::CSS_SELECTOR,
            '.parent',
            null,
            'parent'
        );

        $childIdentifier = TestIdentifierFactory::createElementIdentifier(
            ValueTypes::CSS_SELECTOR,
            '.child',
            null,
            'child',
            $oldParentIdentifier
        );

        $collection = new ElementIdentifierCollection([
            $oldParentIdentifier,
            $childIdentifier,
        ]);

        $newParentIdentifier = TestIdentifierFactory::createElementIdentifier(
            ValueTypes::CSS_SELECTOR,
            '.parent',
            1,
            'parent'
        );

        $expectedNewChildIdentifier = TestIdentifierFactory::createElementIdentifier(
            ValueTypes::CSS_SELECTOR,
            '.child',
            null,
            'child',
            $newParentIdentifier
        );

        $mutatedCollection = $collection->replace($oldParentIdentifier, $newParentIdentifier);

        $this->assertSame($newParentIdentifier, $mutatedCollection->getIdentifier('parent'));
        $this->assertEquals($expectedNewChildIdentifier, $mutatedCollection->getIdentifier('child'));
    }
}
