<?php

declare(strict_types=1);

namespace webignition\BasilModel\Tests\Unit\Page;

use Nyholm\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use webignition\BasilModel\Identifier\IdentifierCollection;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;
use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Page\Page;

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
                    (new DomIdentifier('.foo'))->withName('foo'),
                ]),
                'expectedPage' => new Page(
                    new Uri('http://example.com/'),
                    new IdentifierCollection([
                        (new DomIdentifier('.foo'))->withName('foo'),
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
                (new DomIdentifier('.foo'))->withName('foo'),
                (new DomIdentifier('.bar'))->withName('bar')
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
        $fooIdentifier = (new DomIdentifier('.foo'))->withName('foo');

        $page = new Page(new Uri(''), new IdentifierCollection([
            $fooIdentifier,
        ]));

        $this->assertSame($fooIdentifier, $page->getIdentifier('foo'));
        $this->assertNull($page->getIdentifier('invalid'));
    }
}
