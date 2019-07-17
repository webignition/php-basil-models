<?php

namespace webignition\BasilModel\Identifier;

class IdentifierTypes
{
    const CSS_SELECTOR = 'css-selector';
    const XPATH_EXPRESSION = 'xpath-expression';
    const PAGE_MODEL_ELEMENT_REFERENCE = 'page-model-element-reference';
    const ELEMENT_PARAMETER = 'element-parameter';
    const PAGE_OBJECT_PARAMETER = 'page-object-parameter';
    const BROWSER_OBJECT_PARAMETER = 'browser-object-parameter';

    const ACTIONABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
        self::ELEMENT_PARAMETER,
    ];

    const ASSERTABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
        self::ELEMENT_PARAMETER,
        self::PAGE_OBJECT_PARAMETER,
        self::BROWSER_OBJECT_PARAMETER,
    ];
}
