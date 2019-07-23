<?php

namespace webignition\BasilModel\Identifier;

class IdentifierTypes
{
    const CSS_SELECTOR = 'css-selector';
    const XPATH_EXPRESSION = 'xpath-expression';

    const ACTIONABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
    ];

    const ASSERTABLE_TYPES = [
        self::CSS_SELECTOR,
        self::XPATH_EXPRESSION,
    ];
}
