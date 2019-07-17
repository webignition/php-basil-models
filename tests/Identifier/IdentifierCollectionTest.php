<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierCollection;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueTypes;

class IdentifierCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(array $identifiers, IdentifierCollectionInterface $expectedIdentifierCollection)
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
                    new Identifier(IdentifierTypes::CSS_SELECTOR, new Value(ValueTypes::STRING, '.heading')),
                    new Identifier(IdentifierTypes::XPATH_EXPRESSION, new Value(ValueTypes::STRING, '//button')),
                ],
                'expectedIdentifierCollection' => new IdentifierCollection([
                    new Identifier(IdentifierTypes::CSS_SELECTOR, new Value(ValueTypes::STRING, '.heading')),
                    new Identifier(IdentifierTypes::XPATH_EXPRESSION, new Value(ValueTypes::STRING, '//button')),
                ]),
            ],
            'valid' => [
                'identifiers' => [
                    new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.heading'),
                        1,
                        'heading'
                    ),
                    new Identifier(
                        IdentifierTypes::XPATH_EXPRESSION,
                        new Value(ValueTypes::STRING, '//button'),
                        1,
                        'button'
                    ),
                ],
                'expectedIdentifierCollection' => new IdentifierCollection([
                    new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.heading'),
                        1,
                        'heading'
                    ),
                    new Identifier(
                        IdentifierTypes::XPATH_EXPRESSION,
                        new Value(ValueTypes::STRING, '//button'),
                        1,
                        'button'
                    ),
                ]),
            ],
        ];
    }

    public function testGetIdentifier()
    {
        $headingIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(ValueTypes::STRING, '.heading'),
            1,
            'heading'
        );

        $buttonIdentifier = new Identifier(
            IdentifierTypes::XPATH_EXPRESSION,
            new Value(ValueTypes::STRING, '//button'),
            1,
            'button'
        );

        $identifierCollection = new IdentifierCollection([
            $headingIdentifier,
            $buttonIdentifier,
        ]);

        $this->assertSame($headingIdentifier, $identifierCollection->getIdentifier('heading'));
        $this->assertSame($buttonIdentifier, $identifierCollection->getIdentifier('button'));
        $this->assertNull($identifierCollection->getIdentifier('not-present'));
    }
}
