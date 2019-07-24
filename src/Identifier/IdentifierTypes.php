<?php

namespace webignition\BasilModel\Identifier;

class IdentifierTypes
{
    const CSS_SELECTOR = 'css-selector';
    const XPATH_EXPRESSION = 'xpath-expression';
    const PAGE_ELEMENT_REFERENCE = 'page-element-reference';
    const ELEMENT_PARAMETER = 'element-parameter';

    const ACTIONABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
    ];

    const ASSERTABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
    ];
}
