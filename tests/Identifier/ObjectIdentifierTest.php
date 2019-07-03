<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Identifier\ObjectIdentifier;

class ObjectIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, string $value, string $objectName, string $objectProperty)
    {
        $identifier = new ObjectIdentifier($type, $value, $objectName, $objectProperty);

        $this->assertSame($type, $identifier->getType());
        $this->assertSame($value, $identifier->getValue());
        $this->assertSame($objectName, $identifier->getObjectName());
        $this->assertSame($objectProperty, $identifier->getObjectProperty());
        $this->assertSame(1, $identifier->getPosition());
        $this->assertNull($identifier->getName());
        $this->assertSame($value, (string) $identifier);
    }

    public function createDataProvider(): array
    {
        return [
            'page object identifier' => [
                'type' => IdentifierTypes::PAGE_OBJECT_PARAMETER,
                'value' => '$page.url',
                'objectName' => 'page',
                'objectProperty' => 'url',
            ],
            'browser object identifier' => [
                'type' => IdentifierTypes::BROWSER_OBJECT_PARAMETER,
                'value' => '$browser.size',
                'objectName' => 'browser',
                'objectProperty' => 'size',
            ],
        ];
    }
}
