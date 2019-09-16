<?php

namespace webignition\BasilModel\Tests\DataProvider\Assertion;

use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\DomIdentifierValue;
use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\ObjectValueType;

trait AssertableExaminedValueDataProviderTrait
{
    public function assertableExaminedValueDataProvider(): array
    {
        return [
            'attribute value' => [
                'value' => new DomIdentifierValue(
                    (new DomIdentifier(
                        new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                    ))->withAttributeName('attribute_name')
                ),
            ],
            'browser property' => [
                'value' => new ObjectValue(ObjectValueType::BROWSER_PROPERTY, '$browser.size', 'size'),
            ],
            'element value' => [
                'value' => new DomIdentifierValue(
                    new DomIdentifier(
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
