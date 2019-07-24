<?php

namespace webignition\BasilModel\Identifier;

class IdentifierTypes
{
    const PAGE_ELEMENT_REFERENCE = 'page-element-reference';
    const ELEMENT_PARAMETER = 'element-parameter';
    const ELEMENT_SELECTOR = 'element-selector';

    const ACTIONABLE_TYPES = [
        self::ELEMENT_SELECTOR,
    ];

    const ASSERTABLE_TYPES = [
        self::ELEMENT_SELECTOR,
    ];
}
