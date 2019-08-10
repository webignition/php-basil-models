<?php

namespace webignition\BasilModel\Value;

class ValueTypes
{
    // LiteralValue
    const CSS_SELECTOR = 'css-selector';
    const STRING = 'string';
    const XPATH_EXPRESSION = 'xpath-expression';

    // ObjectValue
    const BROWSER_OBJECT_PROPERTY = 'browser-object-property';
    const DATA_PARAMETER = 'data-parameter';
    const ELEMENT_PARAMETER = 'element-parameter';
    const PAGE_ELEMENT_REFERENCE = 'page-element-reference';
    const PAGE_OBJECT_PROPERTY = 'page-object-property';
    const ATTRIBUTE_PARAMETER = 'attribute-parameter';

    // EnvironmentValue
    const ENVIRONMENT_PARAMETER = 'environment-parameter';

    // ElementValue
    const ELEMENT_IDENTIFIER = 'element-identifier';

    // AttributeValue
    const ATTRIBUTE_IDENTIFIER = 'attribute-identifier';

    const ALL = [
        self::CSS_SELECTOR,
        self::STRING,
        self::XPATH_EXPRESSION,
        self::BROWSER_OBJECT_PROPERTY,
        self::DATA_PARAMETER,
        self::ELEMENT_PARAMETER,
        self::PAGE_ELEMENT_REFERENCE,
        self::PAGE_OBJECT_PROPERTY,
        self::ENVIRONMENT_PARAMETER,
        self::ELEMENT_IDENTIFIER,
    ];

    const ACTIONABLE_TYPES = [
        self::BROWSER_OBJECT_PROPERTY,
        self::CSS_SELECTOR,
        self::DATA_PARAMETER,
        self::ELEMENT_IDENTIFIER,
        self::ELEMENT_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_OBJECT_PROPERTY,
        self::STRING,
        self::XPATH_EXPRESSION,
    ];
}
