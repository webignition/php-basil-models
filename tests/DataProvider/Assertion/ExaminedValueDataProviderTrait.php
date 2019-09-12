<?php

namespace webignition\BasilModel\Tests\DataProvider\Assertion;

use webignition\BasilModel\Identifier\AttributeIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\AttributeReference;
use webignition\BasilModel\Value\AttributeValue;
use webignition\BasilModel\Value\BrowserProperty;
use webignition\BasilModel\Value\DataParameter;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\ElementReference;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Value\EnvironmentValue;
use webignition\BasilModel\Value\PageElementReference;
use webignition\BasilModel\Value\PageProperty;

trait ExaminedValueDataProviderTrait
{
    public function assertionExaminedValueDataProvider(): array
    {
        return [
            'attribute value' => [
                'value' => new AttributeValue(
                    new AttributeIdentifier(
                        new ElementIdentifier(
                            new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                        ),
                        'attribute_name'
                    )
                ),
            ],
            'browser property' => [
                'value' => new BrowserProperty('$browser.size', 'size'),
            ],
            'element value' => [
                'value' => new ElementValue(
                    new ElementIdentifier(
                        new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                    )
                ),
            ],
            'environment value' => [
                'value' => new EnvironmentValue('$env.KEY', 'KEY'),
            ],
            'page element reference' => [
                'value' => new PageElementReference(
                    'page_import_name.elements.element_name',
                    'page_import_name',
                    'element_name'
                ),
            ],
            'element reference' => [
                'value' => new ElementReference(
                    '$elements.element_name',
                    'element_name'
                ),
            ],
            'attribute reference' => [
                'value' => new AttributeReference(
                    '$elements.element_name.attribute_name',
                    'element_name.attribute_name'
                ),
            ],
            'data parameter' => [
                'value' => new DataParameter(
                    '$data.key',
                    'key'
                ),
            ],
            'page property' => [
                'value' => new PageProperty(
                    '$page.url',
                    'url'
                ),
            ],
        ];
    }
}
