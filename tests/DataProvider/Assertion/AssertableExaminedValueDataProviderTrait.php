<?php

namespace webignition\BasilModel\Tests\DataProvider\Assertion;

use webignition\BasilModel\Identifier\AttributeIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\AttributeValue;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\ObjectValueType;

trait AssertableExaminedValueDataProviderTrait
{
    public function assertableExaminedValueDataProvider(): array
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
                'value' => new ObjectValue(ObjectValueType::BROWSER_PROPERTY, '$browser.size', 'size'),
            ],
            'element value' => [
                'value' => new ElementValue(
                    new ElementIdentifier(
                        new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                    )
                ),
            ],
            'environment value' => [
                'value' => new ObjectValue(ObjectValueType::ENVIRONMENT_PARAMETER, '$env.KEY', 'KEY'),
            ],
            'page property' => [
                'value' => new ObjectValue(ObjectValueType::PAGE_PROPERTY, '$page.url', 'url'),
            ],
        ];
    }
}
