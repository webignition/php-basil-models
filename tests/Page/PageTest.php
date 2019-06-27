<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Page;

use Nyholm\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Page\Page;

class PageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(UriInterface $uri, array $elementIdentifiers, Page $expectedPage)
    {
        $page = new Page($uri, $elementIdentifiers);

        $this->assertEquals($expectedPage, $page);
    }

    public function createDataProvider(): array
    {
        return [
            'no elements' => [
                'uri' => new Uri('http://example.com/'),
                'elementIdentifiers' => [],
                'expectedPage' => new Page(new Uri('http://example.com/'), []),
            ],
            'no valid elements' => [
                'uri' => new Uri('http://example.com/'),
                'elementIdentifiers' => [
                    'foo',
                    'bar',
                ],
                'expectedPage' => new Page(new Uri('http://example.com/'), []),
            ],
            'valid elements' => [
                'uri' => new Uri('http://example.com/'),
                'elementIdentifiers' => [
                    'foo' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        '.foo'
                    ),
                    'bar' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        '.bar'
                    ),
                ],
                'expectedPage' => new Page(
                    new Uri('http://example.com/'),
                    [
                        'foo' => new Identifier(
                            IdentifierTypes::CSS_SELECTOR,
                            '.foo'
                        ),
                        'bar' => new Identifier(
                            IdentifierTypes::CSS_SELECTOR,
                            '.bar'
                        ),
                    ]
                ),
            ],
        ];
    }

    public function testGetUri()
    {
        $uri = new Uri();
        $page = new Page($uri, []);

        $this->assertSame($uri, $page->getUri());
    }

    public function testGetElementIdentifier()
    {
        $fooIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            '.foo'
        );

        $barIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            '.bar'
        );

        $page = new Page(
            new Uri('http://example.com/'),
            [
                'foo' => $fooIdentifier,
                'bar' => $barIdentifier,
            ]
        );

        $this->assertSame($fooIdentifier, $page->getElementIdentifier('foo'));
        $this->assertSame($barIdentifier, $page->getElementIdentifier('bar'));
        $this->assertNull($page->getElementIdentifier('non-existent'));
    }

    public function testGetElementNames()
    {
        $fooIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            '.foo'
        );

        $barIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            '.bar'
        );

        $page = new Page(
            new Uri('http://example.com/'),
            [
                'foo' => $fooIdentifier,
                'bar' => $barIdentifier,
            ]
        );

        $this->assertEquals(
            [
                'foo',
                'bar',
            ],
            $page->getElementNames()
        );
    }
}
