<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Page;

use Nyholm\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\IdentifierCollection;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Page\Page;
use webignition\BasilModel\Value\LiteralValue;

class PageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        UriInterface $uri,
        IdentifierCollectionInterface $identifierCollection,
        Page $expectedPage
    ) {
        $page = new Page($uri, $identifierCollection);

        $this->assertEquals($expectedPage, $page);
        $this->assertSame($identifierCollection, $page->getIdentifierCollection());
    }

    public function createDataProvider(): array
    {
        return [
            'no elements' => [
                'uri' => new Uri('http://example.com/'),
                'identifierCollection' => new IdentifierCollection(),
                'expectedPage' => new Page(new Uri('http://example.com/'), new IdentifierCollection()),
            ],
            'valid elements' => [
                'uri' => new Uri('http://example.com/'),
                'identifierCollection' => new IdentifierCollection([
                    (new ElementIdentifier(
                        IdentifierTypes::CSS_SELECTOR,
                        LiteralValue::createCssSelectorValue('.foo')
                    ))->withName('foo'),
                ]),
                'expectedPage' => new Page(
                    new Uri('http://example.com/'),
                    new IdentifierCollection([
                        (new ElementIdentifier(
                            IdentifierTypes::CSS_SELECTOR,
                            LiteralValue::createCssSelectorValue('.foo')
                        ))->withName('foo'),
                    ])
                ),
            ],
        ];
    }

    public function testGetUri()
    {
        $uri = new Uri();
        $page = new Page($uri, new IdentifierCollection());

        $this->assertSame($uri, $page->getUri());
    }

    public function testGetElementNames()
    {
        $page = new Page(
            new Uri('http://example.com/'),
            new IdentifierCollection([
                (new ElementIdentifier(
                    IdentifierTypes::CSS_SELECTOR,
                    LiteralValue::createCssSelectorValue('.foo')
                ))->withName('foo'),
                (new ElementIdentifier(
                    IdentifierTypes::CSS_SELECTOR,
                    LiteralValue::createCssSelectorValue('.bar')
                ))->withName('bar')
            ])
        );

        $this->assertEquals(
            [
                'bar',
                'foo',
            ],
            $page->getElementNames()
        );
    }

    public function testGetElementIdentifier()
    {
        $fooIdentifier = (new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.foo')
        ))->withName('foo');

        $page = new Page(new Uri(''), new IdentifierCollection([
            $fooIdentifier,
        ]));

        $this->assertSame($fooIdentifier, $page->getIdentifier('foo'));
        $this->assertNull($page->getIdentifier('invalid'));
    }
}
