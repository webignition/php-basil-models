<?php

/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Value\DomIdentifierReference;
use webignition\BasilModel\Value\PageObjectReferenceType;

class DomIdentifierReferenceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $type, string $reference, string $property)
    {
        $pageObjectReference = new DomIdentifierReference(
            $type,
            $reference,
            $property
        );

        $this->assertSame($reference, $pageObjectReference->getReference());
        $this->assertSame($property, $pageObjectReference->getProperty());
        $this->assertFalse($pageObjectReference->isActionable());
        $this->assertFalse($pageObjectReference->isEmpty());
        $this->assertSame($reference, (string) $pageObjectReference);
    }

    public function createDataProvider(): array
    {
        return [
            'attribute reference' => [
                'type' => PageObjectReferenceType::ATTRIBUTE,
                'reference' => '$elements.element_name.attribute_name',
                'property' => 'element_name.attribute_name'
            ],
            'element reference' => [
                'type' => PageObjectReferenceType::ELEMENT,
                'reference' => '$elements.element_name',
                'property' => 'element_name'
            ],
        ];
    }
}
