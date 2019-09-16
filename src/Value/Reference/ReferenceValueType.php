<?php

namespace webignition\BasilModel\Value\Reference;

class ReferenceValueType
{
    const ATTRIBUTE_REFERENCE = 'attribute-reference';
    const BROWSER_PROPERTY = 'browser-property';
    const DATA_PARAMETER = 'data-parameter';
    const ELEMENT_REFERENCE = 'element-reference';
    const ENVIRONMENT_PARAMETER = 'environment-parameter';
    const PAGE_PROPERTY = 'page-property';

    const ALL = [
        self::ATTRIBUTE_REFERENCE,
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ELEMENT_REFERENCE,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];

    const ACTIONABLE = [
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];
}
