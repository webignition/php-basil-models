<?php

namespace webignition\BasilModel\Identifier;

class IdentifierTypes
{
    const CSS_SELECTOR = 'css-selector';
    const XPATH_EXPRESSION = 'xpath-expression';
    const PAGE_MODEL_ELEMENT_REFERENCE = 'page-model-element-reference';

    const ACTIONABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
    ];

    const ASSERTABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
    ];
}
