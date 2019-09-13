<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Identifier;

use webignition\BasilModel\Exception\InvalidActionIdentifierException;
use webignition\BasilModel\Identifier\ActionIdentifier;
use webignition\BasilModel\Identifier\ActionIdentifierInterface;
use webignition\BasilModel\Identifier\AttributeIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ReferenceIdentifier;
use webignition\BasilModel\Value\AttributeReference;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\ElementReference;
use webignition\BasilModel\Value\PageElementReference;

class ActionIdentifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getActionIdentifierSuccessDataProvider
     */
    public function testGetActionIdentifierSuccess(ActionIdentifierInterface $identifier)
    {
        $this->expectNotToPerformAssertions();

        $identifier->getActionIdentifier();
    }

    public function getActionIdentifierSuccessDataProvider(): array
    {
        return [
            'element identifier' => [
                'identifier' => new ActionIdentifier(
                    new ElementIdentifier(
                        new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                    )
                ),
            ],
            'element reference' => [
                'identifier' => new ActionIdentifier(
                    ReferenceIdentifier::createElementReferenceIdentifier(
                        new ElementReference(
                            '$elements.element_name',
                            'element_name'
                        )
                    )
                ),
            ],
        ];
    }

    /**
     * @dataProvider getActionIdentifierThrowsExceptionDataProvider
     */
    public function testGetActionIdentifierThrowsException(ActionIdentifierInterface $identifier)
    {
        $this->expectException(InvalidActionIdentifierException::class);

        $identifier->getActionIdentifier();
    }

    public function getActionIdentifierThrowsExceptionDataProvider(): array
    {
        return [
            'attribute identifier' => [
                'identifier' => new ActionIdentifier(
                    new AttributeIdentifier(
                        new ElementIdentifier(
                            new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                        ),
                        'attribute_name'
                    )
                ),
            ],
            'attribute reference' => [
                'identifier' => new ActionIdentifier(
                    ReferenceIdentifier::createAttributeReferenceIdentifier(
                        new AttributeReference(
                            '$elements.element_name.attribute_name',
                            'element_name.attribute_name'
                        )
                    )
                ),
            ],
            'page element reference' => [
                'identifier' => new ActionIdentifier(
                    ReferenceIdentifier::createPageElementReferenceIdentifier(
                        new PageElementReference(
                            'page_import_name.elements.element_name',
                            'page_import_name',
                            'element_name'
                        )
                    )
                ),
            ],
        ];
    }
}
