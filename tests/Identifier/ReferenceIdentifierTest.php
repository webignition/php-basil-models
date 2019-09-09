<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Identifier;

use webignition\BasilModel\Identifier\ReferenceIdentifier;
use webignition\BasilModel\Identifier\IdentifierInterface;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\ElementReference;
use webignition\BasilModel\Value\ObjectNames;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\ReferenceValueInterface;
use webignition\BasilModel\Value\ValueTypes;

class ReferenceIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, ReferenceValueInterface $value)
    {
        $identifier = new ReferenceIdentifier($type, $value);

        $this->assertSame($type, $identifier->getType());
        $this->assertSame($value, $identifier->getValue());
    }

    public function createDataProvider(): array
    {
        return [
            'page element reference' => [
                'type' => IdentifierTypes::PAGE_ELEMENT_REFERENCE,
                'value' => new PageElementReference(
                    ValueTypes::PAGE_ELEMENT_REFERENCE,
                    'page_import_name.elements.element_name',
                    'page_import_name',
                    'element_name'
                ),
            ],
            'element reference' => [
                'type' => IdentifierTypes::ELEMENT_PARAMETER,
                'value' => new ElementReference(
                    ValueTypes::ELEMENT_PARAMETER,
                    '$elements.element_name',
                    ObjectNames::ELEMENT,
                    'element_name'
                ),
            ],
        ];
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
                'identifier' => new ReferenceIdentifier(
                    IdentifierTypes::PAGE_ELEMENT_REFERENCE,
                    new PageElementReference(
                        ValueTypes::PAGE_ELEMENT_REFERENCE,
                        'page_import_name.elements.element_name',
                        'page_import_name',
                        'element_name'
                    )
                ),
                'expectedString' => 'page_import_name.elements.element_name',
            ],
            'element reference' => [
                'identifier' => new ReferenceIdentifier(
                    IdentifierTypes::ELEMENT_PARAMETER,
                    new ElementReference(
                        ValueTypes::ELEMENT_PARAMETER,
                        '$elements.element_name',
                        ObjectNames::ELEMENT,
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
        $identifier = new ReferenceIdentifier(
            IdentifierTypes::PAGE_ELEMENT_REFERENCE,
            new ElementReference(
                ValueTypes::ELEMENT_PARAMETER,
                '$elements.element_name',
                ObjectNames::ELEMENT,
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