<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\ReferenceIdentifier;
use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Identifier\ReferenceIdentifierInterface;
use webignition\BasilModel\Value\ElementReference;
use webignition\BasilModel\Value\PageElementReference;

class ReferenceIdentifierTest extends \PHPUnit\Framework\TestCase
{
    public function testCreatePageElementReferenceIdentifier()
    {
        $value = new PageElementReference(
            'page_import_name.elements.element_name',
            'page_import_name',
            'element_name'
        );

        $identifier = ReferenceIdentifier::createPageElementReferenceIdentifier($value);

        $this->assertInstanceOf(ReferenceIdentifierInterface::class, $identifier);
        $this->assertSame($value, $identifier->getValue());
    }

    public function testCreateElementReferenceIdentifier()
    {
        $value = new ElementReference(
            '$elements.element_name',
            'element_name'
        );

        $identifier = ReferenceIdentifier::createPageElementReferenceIdentifier($value);

        $this->assertInstanceOf(ReferenceIdentifierInterface::class, $identifier);
        $this->assertSame($value, $identifier->getValue());
    }
    /**
     * @dataProvider toStringDataProvider
     */
    public function testToString(IdentifierInterface $identifier, string $expectedString)
    {
        $this->assertSame($expectedString, (string) $identifier);
    }

    public function toStringDataProvider(): array
    {
        return [
            'page element reference' => [
                'identifier' => ReferenceIdentifier::createPageElementReferenceIdentifier(
                    new PageElementReference(
                        'page_import_name.elements.element_name',
                        'page_import_name',
                        'element_name'
                    )
                ),
                'expectedString' => 'page_import_name.elements.element_name',
            ],
            'element reference' => [
                'identifier' => ReferenceIdentifier::createElementReferenceIdentifier(
                    new ElementReference(
                        '$elements.element_name',
                        'element_name'
                    )
                ),
                'expectedString' => '$elements.element_name',
            ],
        ];
    }

    /**
     * @dataProvider withNameDataProvider
     */
    public function testWithName(
        IdentifierInterface $identifier,
        string $name,
        IdentifierInterface $expectedIdentifier
    ) {
        $updatedIdentifier = $identifier->withName($name);

        $this->assertNotSame($identifier, $updatedIdentifier);
        $this->assertEquals($expectedIdentifier, $updatedIdentifier);
    }

    public function withNameDataProvider(): array
    {
        $identifier = ReferenceIdentifier::createElementReferenceIdentifier(
            new ElementReference(
                '$elements.element_name',
                'element_name'
            )
        );

        return [
            'no name, no new name' => [
                'identifier' => $identifier,
                'name' => '',
                'expectedIdentifier' => $identifier,
            ],
            'has name, no new name' => [
                'identifier' => $identifier->withName('identifier name'),
                'name' => '',
                'expectedIdentifier' => $identifier,
            ],
            'no name, has new name' => [
                'identifier' => $identifier,
                'name' => 'identifier name',
                'expectedIdentifier' => $identifier->withName('identifier name'),
            ],
            'has name, has new name' => [
                'identifier' => $identifier->withName('current identifier name'),
                'name' => 'new identifier name',
                'expectedIdentifier' => $identifier->withName('new identifier name'),
            ],
        ];
    }
}
