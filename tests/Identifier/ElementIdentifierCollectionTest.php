<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierCollection;
use webignition\BasilModel\Value\LiteralValue;

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
                    new ElementIdentifier(LiteralValue::createStringValue('.heading')),
                ],
                'expectedIdentifierCollection' => new ElementIdentifierCollection([
                    new ElementIdentifier(LiteralValue::createStringValue('.heading')),
                ]),
            ],
            'valid' => [
                'identifiers' => [
                    (new ElementIdentifier(
                        LiteralValue::createStringValue('.heading'),
                        1
                    ))->withName('heading'),
                ],
                'expectedIdentifierCollection' => new ElementIdentifierCollection([
                    (new ElementIdentifier(
                        LiteralValue::createStringValue('.heading'),
                        1
                    ))->withName('heading'),
                ]),
            ],
        ];
    }

    public function testGetIdentifier()
    {
        $headingIdentifier = (new ElementIdentifier(
            LiteralValue::createStringValue('.heading'),
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
            LiteralValue::createStringValue('.heading'),
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
}
