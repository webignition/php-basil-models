<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\IdentifierCollection;
use webignition\BasilModel\Value\CssSelector;

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
                    new ElementIdentifier(new CssSelector('.heading')),
                ],
                'expectedIdentifierCollection' => new IdentifierCollection([
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
                'expectedIdentifierCollection' => new IdentifierCollection([
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

        $identifierCollection = new IdentifierCollection([
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

        $identifierCollection = new IdentifierCollection($identifiers);

        foreach ($identifierCollection as $index => $identifier) {
            $this->assertSame($identifiers[$index], $identifier);
        }
    }
}
